    function refreshTable() {
        $.ajax({
            url: "{{ route('main.refresh') }}",
            method: "GET",
            success: function(response) {
                // Update the table with the latest data
                $('#products-tablebody').empty();
                $.each(response.mains, function(index, main) {
                    $('#products-tablebody').append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${main.date}</td>
                            <td>${main.pf_retry}</td>
                            <td>${main.pf_ng}</td>
                            <td>${main.atsu_retry}</td>
                            <td>${main.atsu_ng}</td>
                            <td>
                                <a href="{{ route('main.edit', ' + main.id + ') }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('main.destroy', ' + main.id + ') }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirmAction('menghapus')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Call the refreshTable function initially and then at regular intervals
    refreshTable();
    setInterval(refreshTable, 3000); // Refresh every minute (adjust as needed)

    // Add a click event listener to the refresh button
    $('#refresh-table').click(function() {
        refreshTable();
    });
