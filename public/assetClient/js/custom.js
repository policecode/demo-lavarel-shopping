function handleComment() {
    let commentIcons = document.querySelectorAll('.comment-icon');
    let formComment = document.querySelector('#form-comment-js');
    let replyComment = formComment.querySelector('.reply-to-comment');
    let inputParent = formComment.querySelector('input[name="parent_id"]');
    if (commentIcons) {
        commentIcons.forEach(element => {
            // console.log(element.getAttribute('data-id'),' ', element.getAttribute('data-name'));
            element.onclick = function (e) {
                replyComment.innerHTML = `<p>Trả lời bình luận của: 
                                    <span>${element.getAttribute('data-name')}</span>
                                    <i class="fa-solid fa-rectangle-xmark close-reply-comment"></i>
                                </p>`;
                inputParent.value = element.getAttribute('data-id');
                handleCloseReplyComment(replyComment, inputParent);
            }
        });
    }
}
handleComment();

function handleCloseReplyComment(replyComment, inputParent) {
    let closeReplyComment = document.querySelector('.close-reply-comment');
    closeReplyComment.onclick = function (e) {
        replyComment.removeChild(closeReplyComment.parentNode);
        inputParent.value = 0;
    }
}

