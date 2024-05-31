document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault();
        let command = document.getElementById('command').value;

        fetch('search.php?command=' + encodeURIComponent(command))
            .then(response => response.json())
            .then(data => {
                let resultsDiv = document.getElementById('results');
                if (data.success) {
                    resultsDiv.innerHTML = `<p><strong>${command}</strong>: ${data.description}</p>`;
                } else {
                    resultsDiv.innerHTML = `<p>No results found for "<strong>${command}</strong>".</p>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('results').innerHTML = '<p>An error occurred while fetching the command. Please try again later.</p>';
            });
    });

    document.getElementById('suggestionForm').addEventListener('submit', function(event) {
        event.preventDefault();
        let newCommand = document.getElementById('newCommand').value;
        let description = document.getElementById('description').value;

        fetch('suggest.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ command: newCommand, description: description })
        })
        .then(response => response.json())
        .then(data => {
            let suggestionResultDiv = document.getElementById('suggestionResult');
            if (data.success) {
                suggestionResultDiv.innerHTML = `<p>Suggestion submitted successfully!</p>`;
            } else {
                suggestionResultDiv.innerHTML = `<p>${data.message}</p>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            suggestionResultDiv.innerHTML = '<p>An error occurred while submitting the suggestion. Please try again later.</p>';
        });
    });
});

