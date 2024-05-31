document.addEventListener('DOMContentLoaded', function() {
    function fetchSuggestions() {
        fetch('get_suggestions.php')
            .then(response => response.json())
            .then(data => {
                let suggestionListDiv = document.getElementById('suggestionList');
                suggestionListDiv.innerHTML = '';
                data.suggestions.forEach(suggestion => {
                    suggestionListDiv.innerHTML += `
                        <div class="suggestion">
                            <p><strong>Command:</strong> ${suggestion.command}</p>
                            <p><strong>Description:</strong> ${suggestion.description}</p>
                            <button onclick="approveSuggestion('${suggestion.id}')">Approve</button>
                            <button onclick="deleteSuggestion('${suggestion.id}')">Delete</button>
                        </div>
                    `;
                });
            })
            .catch(error => {
                console.error('Error:', error);
                suggestionListDiv.innerHTML = '<p>An error occurred while fetching suggestions. Please try again later.</p>';
            });
    }

    document.getElementById('addCommandForm').addEventListener('submit', function(event) {
        event.preventDefault();
        let newCommand = document.getElementById('adminNewCommand').value;
        let description = document.getElementById('adminDescription').value;

        fetch('add_command.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ command: newCommand, description: description })
        })
        .then(response => response.json())
        .then(data => {
            let addCommandResultDiv = document.getElementById('addCommandResult');
            if (data.success) {
                addCommandResultDiv.innerHTML = `<p>Command added successfully!</p>`;
                fetchSuggestions();
            } else {
                addCommandResultDiv.innerHTML = `<p>There was an error adding the command. Please try again.</p>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            addCommandResultDiv.innerHTML = '<p>An error occurred while adding the command. Please try again later.</p>';
        });
    });

    fetchSuggestions();
});

function approveSuggestion(id) {
    fetch('approve_suggestion.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: id })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            fetchSuggestions();
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function deleteSuggestion(id) {
    fetch('delete_suggestion.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: id })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            fetchSuggestions();
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

