<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Command Lookup Tool - Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Command Lookup Tool - Admin</h1>
    </header>

    <main>
        <section id="reviewSuggestions">
            <h2>Review Suggestions</h2>
            <div id="suggestionList">
                <!-- This will be populated with suggestions from the server -->
            </div>
        </section>

        <section id="addCommand">
            <h2>Add a New Command</h2>
            <form id="addCommandForm">
                <input type="text" id="adminNewCommand" name="newCommand" placeholder="New command">
                <textarea id="adminDescription" name="description" placeholder="Command description"></textarea>
                <button type="submit">Add Command</button>
            </form>
            <div id="addCommandResult"></div>
        </section>
    </main>

    <footer>
        <p>Contact us at info@commandlookup.com</p>
        <p>&copy; 2024 Command Lookup Tool</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function fetchSuggestions() {
                fetch('commands.php?action=get_suggestions')
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
                    });
            }

            document.getElementById('addCommandForm').addEventListener('submit', function(event) {
                event.preventDefault();
                let newCommand = document.getElementById('adminNewCommand').value;
                let description = document.getElementById('adminDescription').value;

                fetch('commands.php?action=add', {
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
                });
            });

            fetchSuggestions();
        });

        function approveSuggestion(id) {
            fetch('commands.php?action=approve', {
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
            fetch('commands.php?action=delete', {
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
    </script>
</body>
</html>

