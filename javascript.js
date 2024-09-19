// Functionality to toggle a hamburger menu icon and associated actions
$(document).ready(function() {
    $('#hamburgesa').click(function(e) {
        e.preventDefault(); // Prevents the default action of the clicked element
        $('#menu').toggleClass('active');
        $('.logoCH').toggleClass('opacity'); 
        $('.Desktop1').toggleClass('opacity'); 
        $('.footer').toggleClass('opacity'); 
        const actualRoute = $(this).attr('src');

        // Changes the source attribute of the clicked element based on its current state
        if (actualRoute == 'hamburgesa.png') {
            $(this).attr('src', 'cross.png');
        } else {
            $(this).attr('src', 'hamburgesa.png');
        }
    });
});

// Function to retrieve a cookie by name
function getCookie(name) {
    var nameEQ = name + "=";
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1, cookie.length);
        }
        if (cookie.indexOf(nameEQ) === 0) {
            return cookie.substring(nameEQ.length, cookie.length);
        }
    }
    return "";
}

// Functionality to create a file
$(document).ready(function() {
    $('#createFileBtn').on('click', function() {
        const fileNameWithType = prompt('Please, enter a file name with type (e.g., file_name.py):');

        // Validates user input for file name and type
        if (fileNameWithType !== null && fileNameWithType.trim() !== '') {
            const fileType = fileNameWithType.split('.').pop(); // Extracts the file type
            const fileName = fileNameWithType.split('.').slice(0, -1).join('.'); // Extracts the file name

            // Checks if the file type and name are not empty
            if (fileType !== '' && fileName !== '') {
                const content = $('#dynamicText').text(); // Retrieves content from an element

                // Sends an AJAX POST request to handle file creation
                $.ajax({
                    method: 'POST',
                    url: 'mainManager.php',
                    data: { fileName: fileNameWithType, content: content }, // Sends file details as data
                    dataType: 'json', // Expects JSON response from the server
                    success: function(response) {
                        console.log('Response:', response); // Logs the server response

                        // Display visual messages to the user based on server response
                        if (response.status === 'success') {
                            alert('File created successfully and saved in the database.');
                            if (fileNameWithType.toLowerCase() === 'arxiupy.py') {
                                $('.ArxiuPy').text(fileName);
                            } else if (fileNameWithType.toLowerCase() === 'arxiu2py.py') {
                                $('.Arxiu2Py').text(fileName);
                            }
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(err) {
                        console.error('Error to create the file', err); // Logs error if file creation fails
                        alert('Error occurred while creating the file.');
                    }
                });
            } else {
                alert('Please, enter a valid file name with type (e.g., file_name.py)');
            }
        } else {
            alert('Please, enter a valid file name with type (e.g., file_name.py)');
        }
    });
});