import pyodbc
from collections import defaultdict
from datetime import datetime, timedelta, timezone
import struct

# Destination database connection details
destination_server = '127.0.0.1'
destination_database = 'Chcecksheet_Machine_Tokusei_Index'
destination_username = 'jaki'
destination_password = 'erytchandra12'

# Source database connection details
source_server = destination_server
source_database = 'Chcecksheet_Machine_Tokusei'
source_username = 'jaki'
source_password = 'erytchandra12'

# Mapping of defect names to column names in inline_defect_index
defect_mapping = {
    'PF_RETRY': 'pf_retry',
    'PF_NG': 'pf_ng',
    'ATSU_RETRY': 'atsu_retry',
    'ATSU_NG': 'atsu_ng'
}

# Define the Output Converter function for DATETIMEOFFSET
def handle_datetimeoffset(dto_value):
    tup = struct.unpack("<6hI2h", dto_value)
    return datetime(tup[0], tup[1], tup[2], tup[3], tup[4], tup[5], tup[6] // 1000, timezone(timedelta(hours=tup[7], minutes=tup[8])))

source_cursor = None
destination_cursor = None
source_connection = None
destination_connection = None

try:
    # Connect to the source and destination databases
    source_connection = pyodbc.connect(f'DRIVER=ODBC Driver 17 for SQL Server;SERVER={source_server};DATABASE={source_database};UID={source_username};PWD={source_password}')
    destination_connection = pyodbc.connect(f'DRIVER=ODBC Driver 17 for SQL Server;SERVER={destination_server};DATABASE={destination_database};UID={destination_username};PWD={destination_password}')

    # Add the Output Converter function to the source and destination connections
    source_connection.add_output_converter(-155, handle_datetimeoffset)
    destination_connection.add_output_converter(-155, handle_datetimeoffset)

    # Create cursors for both connections
    source_cursor = source_connection.cursor()
    destination_cursor = destination_connection.cursor()

    # Fetch data from the source table
    source_cursor.execute('SELECT defect_name, quantity, date FROM inline_defect WHERE line_id = 168')
    rows = source_cursor.fetchall()

    # Dictionary to store quantities for each defect type on the same day
    daily_quantities = defaultdict(lambda: defaultdict(int))
    for row in rows:
        defect_name, quantity, date = row
        if defect_name in defect_mapping:
            date_str = date.strftime('%Y-%m-%d')  # Format date as YYYY-MM-DD
            daily_quantities[date_str][defect_name] += quantity

    # Insert data into the destination table
    for date_str, defect_quantities in daily_quantities.items():
        # Check if a row with the same line_id and date already exists
        destination_cursor.execute("SELECT * FROM inline_defect_index WHERE line_id = 168 AND date = ?", date_str)
        existing_row = destination_cursor.fetchone()
        if existing_row:
            # If a row exists, update the existing row
            update_values = ", ".join([f"{column} = {column} + {quantity}" for column, quantity in defect_quantities.items()])
            destination_cursor.execute(f"UPDATE inline_defect_index SET {update_values} WHERE line_id = 168 AND date = ?", date_str)
        else:
            # If no row exists, insert a new row
            columns = ", ".join(defect_mapping.values())
            values = ", ".join([str(defect_quantities.get(column, 0)) for column in defect_mapping.values()])
            destination_cursor.execute(f"INSERT INTO inline_defect_index (line_id, date, {columns}) VALUES (168, ?, {values})", date_str)

    # Commit the transaction
    destination_connection.commit()

    print("Data transfer completed successfully.")

except pyodbc.Error as e:
    print(f"Error: {e}")
finally:
    # Close cursors and connections if they are not None
    if source_cursor:
        source_cursor.close()
    if destination_cursor:
        destination_cursor.close()
    if source_connection:
        source_connection.close()
    if destination_connection:
        destination_connection.close()
