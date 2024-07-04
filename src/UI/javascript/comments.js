document.addEventListener('DOMContentLoaded', function () {
    // Función para cargar los comentarios
    function loadComments() {
        fetch('./controllers/getComments.php')
            .then(response => response.json())
            .then(comments => {
                const commentsList = document.getElementById('commentsList');
                commentsList.innerHTML = ''; // Limpiar la lista de comentarios

                comments.forEach(comment => {
                    const commentItem = document.createElement('div');
                    commentItem.className = 'comment-item';
                    commentItem.innerHTML = `
                        <p><strong>${comment.nameUser}:</strong> ${comment.comment}</p>
                    `;
                    // Agregar respuestas si existen
                    if (comment.responses.length > 0) {
                        const responseList = document.createElement('div');
                        responseList.className = 'response-list';
                        comment.responses.forEach(response => {
                            responseList.innerHTML += `
                                <div class="response-item">
                                    <p><strong>${response[0]}:</strong> <span class="response-text">${response[1]}</span></p>
                                </div>
                            `;
                        });
                        commentItem.appendChild(responseList);
                    }
                    // Formulario para agregar respuesta
                    const responseForm = document.createElement('form');
                    responseForm.className = 'response-form';
                    responseForm.innerHTML = `
                        <input type="hidden" name="comment_id" value="${comment.id}">
                        <label for="response_${comment.id}">Responder:</label>
                        <textarea id="response_${comment.id}" name="response" rows="2" cols="50"></textarea>
                        <input type="button" class="submitResponse" value="Responder">
                    `;
                    commentItem.appendChild(responseForm);

                    commentsList.appendChild(commentItem);
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Cargar comentarios al cargar la página
    loadComments();

    // Manejar el envío de comentarios y respuestas
    document.getElementById('submitComment').addEventListener('click', function () {
        const commentText = document.getElementById('commentText').value;
        if (commentText.trim() !== '') {
            fetch('./controllers/addComments.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ comment: commentText })
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    // Limpiar el campo de comentario
                    document.getElementById('commentText').value = '';
                    // Recargar los comentarios
                    loadComments();
                } else {
                    console.error('Error al agregar comentario:', result.error);
                }
            })
            .catch(error => loadComments());
        }
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('submitResponse')) {
            const commentId = event.target.parentElement.querySelector('[name="comment_id"]').value;
            const responseText = event.target.parentElement.querySelector('[name="response"]').value;
            if (responseText.trim() !== '') {
                fetch('./controllers/addResponse.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ commentId: commentId, response: responseText }) // Corregido el nombre de la propiedad comment_id a commentId
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(result => {
                    if (result.success) {
                        // Limpiar el campo de respuesta
                        event.target.parentElement.querySelector('[name="response"]').value = '';
                        // Recargar los comentarios
                        loadComments();
                    } else {
                        console.error('Error al agregar respuesta:', result.error);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
    });
    
});
