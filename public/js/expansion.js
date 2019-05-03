$(document).ready(function(){
    function search(query) {
        alert('here')

        $.ajax({
            url: "{{ route('search') }}",
            method: "GET",
            dataType: 'json',
            data: {
                query: query
            },
            success: function(data) {
                $('#search-content').html(data)
            }
        })
    }
})