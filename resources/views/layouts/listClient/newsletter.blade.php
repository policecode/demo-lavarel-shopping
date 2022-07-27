<section class="news-letter padding-top-150 padding-bottom-150">
    <div class="container">
        <div class="heading light-head text-center margin-bottom-30">
            <h4>{{ getOptionSetting('newsletter', 'name') }}</h4>
            <span>{!! getOptionSetting('newsletter', 'opt_value') !!}</span>
        </div>
        <form method="post" action="{{ route('dang-ky-nhan-tin') }}" id="newsletter-form">
            <p style="color: #fff; background-color: rgb(109, 155, 215); text-align: center;"></p>
            <input type="text" name="email" placeholder="nhập địa chỉ email của bạn" class="newsletter-control">
            <button type="submit">Gửi đi</button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" class="newsletter-control">
            <span class="error-newsletter"></span>
        </form>
    </div>
</section>

{{-- color: #fff; background-color: rgb(235, 138, 138); text-align: center; --}}
{{-- color: #fff; background-color: rgb(109, 155, 215); text-align: center; --}}

<script>
    function handleFormNewsletter() {
        let newsletterForm = document.querySelector('#newsletter-form');
        if (newsletterForm) {
            let values = newsletterForm.querySelectorAll('.newsletter-control');
            // console.log(newsletterForm.action);
            newsletterForm.onsubmit = function(e) {
                e.preventDefault();
                // if (timeStatus != null) {
                //     clearTimeout(timeStatus);
                // }
                let data = {};
                values.forEach(element => {
                    data[element.name] = element.value;
                });
                fetch('{{ route('dang-ky-nhan-tin') }}', {
                        method: 'POST', // or 'PUT'
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data),
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(response => {
                        let status = response.status;
                        if (status == 'errors') {
                            let error = response.errors.email[0];
                            let spanText = newsletterForm.querySelector('.error-newsletter');
                            spanText.innerText = error;
                            let timeStatus = setTimeout(() => {
                                spanText.innerText = '';
                            }, 3000);
                        }
                        if (status == 'success') {
                            console.log(response);
                            let successText = newsletterForm.querySelector('p');
                            successText.innerText = response.msg;
                            values.forEach(element => {
                                if (element.name != '_token') {
                                    element.value = '';
                                }
                            });
                            let timeStatus = setTimeout(() => {
                                successText.innerText = '';
                            }, 5000);
                        }
                    })
                    .catch(error => {
                        console.log('error: ', error);

                    })
            }
        }


    }
    handleFormNewsletter();
</script>
