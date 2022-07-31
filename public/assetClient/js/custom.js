const formatter = new Intl.NumberFormat();

// Xử lý phần bình luận trong phần chi tiết mặt hàng
function handleComment() {
    let commentIcons = document.querySelectorAll('.comment-icon');
    let formComment = document.querySelector('#form-comment-js');
    if (commentIcons && formComment) {
        let replyComment = formComment.querySelector('.reply-to-comment');
        let inputParent = formComment.querySelector('input[name="parent_id"]');
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

// tìm thẻ cha
function searchParentElement(element, classParent) {
    while (true) {
        element = element.parentElement;
        if (element.classList.contains(classParent)) {
            return element;
        }
    }
}
// Xử lý thay đỗi thông tin form giỏ hàng
function handleShoppingCart() {
    let formShoppingCart = document.querySelector('#shopping-cart-js');
    // Xử lý form lựa chọn sản phẩm
    if (formShoppingCart) {
        // Xóa sản phẩm ra khỏi giỏ hàng
        let closeShoppingCart = formShoppingCart.querySelectorAll('.close-shopping-cart');
        closeShoppingCart.forEach(element => {
            element.onclick = function (e) {
                e.preventDefault();
                const check = confirm('Bạn có chắc chắn muốn xóa sản phẩm này ra khỏi giỏ hàng?');
                if (check) {
                    fetch(element.href)
                        .then(response => response.json())
                        .then(response => {
                            if (response.status == 'success') {
                                element.parentElement.parentElement.parentElement.parentElement.removeChild(element.parentElement.parentElement.parentElement);
                                $count = response.countCart
                                handleviewCountCart($count);
                            }
                        })
                        .catch(error => console.log(error));
                }
            }
        });
        // Chọn số lượng sản phẩm muốn mua
        let qtyShoppingCart = formShoppingCart.querySelectorAll('.qty-shopping-cart');
        qtyShoppingCart.forEach(element => {
            element.onchange = function (e) {
                const parent = searchParentElement(element, 'parent-shopping-cart');
                const price = parent.querySelector('.many-js').getAttribute('data-price');
                const qty = e.target.value;
                const token = e.target.getAttribute('data-token');
                const link = e.target.getAttribute('data-link');
                let totalPrice = parent.querySelector('.total-many-js');
                // Thao tác thay đổi dữ liệu lên session
                let data = {
                    qty: qty,
                    _token: token,
                    _method: 'put'
                };
                fetch(link, {
                    method: 'POST', // or 'PUT'
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                })
                    .then(response => response.json())
                    .then(response => {
                        if (response.status = 'success') {
                            totalPrice.innerHTML = `<small>VNĐ</small>${formatter.format(price * qty).toLocaleString()}`;
                            handleShowOrder();
                        }
                    })
                    .catch(err => console.log(err));
            }
        })
    }
}
handleShoppingCart();

// In ra màn hình hóa đơn
function handleShowOrder() {
    let formOrder = document.querySelector('.order-detail-js');
    if (formOrder) {
        const linkApi = formOrder.getAttribute('data-link');
        fetch(linkApi)
            .then(response => response.json())
            .then(response => {
                if (response.status == 'success') {
                    const allCart = response.allCart;
                    const totalPrice = response.totalPrice;
                    let html = '';
                    if (allCart) {
                        allCart.forEach(element => {
                            html += `<p>${element.name}  x${element.qty}<span>${formatter.format(element.price * element.qty)} đ</span></p>`;
                        });
                    }
                    html += `<p class="all-total">TỔNG TIỀN <span>${formatter.format(totalPrice)} đ</span></p>`;
                    formOrder.innerHTML = html;
                }
            })
            .catch(error => console.log(error));
    }
    console.log();
}
handleShowOrder();

// Xử lý form thanh toán
function handlePaymentProduct() {
    const formPaymentProduct = document.querySelector('#form-payment-product');
    if (formPaymentProduct) {
        const orderDetail = document.querySelector('.order-detail-js');
        if (orderDetail) {
            const linkApi = orderDetail.getAttribute('data-link');
            if (linkApi) {
                fetch(linkApi)
                .then(response => response.json())
                .then(response => {
                    if (response.status == 'success') {
                        let totalPrice = response.totalPrice;
                        formPaymentProduct.onsubmit = (e) => {
                                e.preventDefault();
                                if (totalPrice > 0) {
                                    formPaymentProduct.submit();
                                } else {
                                    orderDetail.innerHTML = `<p class="all-total" style="background-color: rgb(225, 128, 128); color: #fff;">Mời bạn chọn sản phẩm để thanh toán</p>`;
                                    setTimeout(()=>{
                                        orderDetail.innerHTML = '';
                                    }, 3000)
                                }
                            }
                        }
                    })
                    .catch(error => console.log(error));
            }

           

        }
    }
}
handlePaymentProduct();

// Xử lý icon thêm vào giỏ hàng 
function handleAddToCart() {
    let addToCartBtns = document.querySelectorAll('.add-to-cart-js');
    if (addToCartBtns) {
        addToCartBtns.forEach(element => {
            element.onclick = (e) => {
                e.preventDefault();
                fetch(element.href)
                    .then(response => response.json())
                    .then(response => {
                        $count = response.countCart
                        handleviewCountCart($count);
                    })
                    .catch(error => console.log(error));
            }
        });
    }
}
handleAddToCart();
// Xử lý in số liệu trên nút giỏ hàng
function handleviewCountCart($count) {
    let viewCountCart = document.querySelector('.view-count-cart-js');
    if (viewCountCart) {
        if ($count > 0) {
            viewCountCart.innerHTML = `Giỏ hàng
                <span class="badge badge-danger">
                    +${$count}
                </span>`
        } else {
            viewCountCart.innerHTML = `Giỏ hàng`;
        }
    }
}