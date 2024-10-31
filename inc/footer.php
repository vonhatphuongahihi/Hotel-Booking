<div class="container-fluid bg-white mt-5">
        <div class="row">
            <div class="col-lg-4 p-4">
                <h3 class="h-font fw-bold fs-3 mb-2">TJ HOTEL</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Quos voluptate vero sed tempore illo atque beatae asperiores,
                    adipisci dicta quia nisi voluptates impedit perspiciatis, nobis
                    libero culpa error officiis totam?
                </p>
            </div>
            <div class="col-lg-4 p-4">
                <h5 class="mb-3">Links</h5>
                <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a> <br>
                <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a> <br>
                <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a> <br>
                <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact us</a> <br>
                <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About</a>
            </div>
            <div class="col-lg-4 p-4">
                <h5 class="mb-3">Follow us</h5>
                <?php
                if($contact_r['tw']!='')
                {
                    echo<<<data
                          <a href="$contact_r[tw]" class="d-inline-block text-dark text-decoration-none mb-2">
                           <i class="bi bi-twitter-x me-1"></i> X (Twitter)
                          </a><br>
                    data;
                }
                ?>
                <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block text-dark text-decoration-none mb-2">
                    <i class="bi bi-facebook me-1"></i> Facebook
                </a><br>
                <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block text-dark text-decoration-none">
                    <i class="bi bi-instagram me-1"></i> Instagram
                </a><br>
            </div>
        </div>
    </div>

<h6 class="text-center bg-dark text-white p-3 m-0">Designed and Developed by TJ WEBDEV</h6>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function alert(type,msg,position='body')
        {
            let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
            let element = document.createElement('div');
            element.innerHTML = `
                <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
                    <strong class="me-3">${msg}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;


            if(position == 'body'){
                document.body.append(element);
                element.classList.add('custom-alert');
            }
            else{
                document.getElementById(position).appendChild(element);
            }

            setTimeout(remAlert, 3000);
        }

        function remAlert(){
            document.getElementsByClassName('alert')[0].remove();
        }

        function setActive()
        {
            let navbar = document.getElementById('nav-bar');
            let a_tags = navbar.getElementsByTagName('a');

            for (i=0;i<a_tags.length;i++)
            {
                let file = a_tags[i].href.split('/').pop(); 
                let file_name = file.split('.')[0]; 

                if(document.location.href.indexOf(file_name)>=0)
                {
                    a_tags[i].classList.add('active');
                }
            }
        }
        
        let register_form =  document.getElementById('register-form');

        register_form.addEventListener('submit', (e)=>{
            e.preventDefault();

            let data = new FormData(register_form);
            data.append('register','');

            var myModal = document.getElementById('registerModal');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
            data.append('name',register_form.elements['name'].value);
            data.append('email',register_form.elements['email'].value);
            data.append('phonenum',register_form.elements['phonenum'].value);
            data.append('address',register_form.elements['address'].value);
            data.append('pincode',register_form.elements['pincode'].value);
            data.append('dob',register_form.elements['dob'].value);
            data.append('pass',register_form.elements['pass'].value);
            data.append('cpass',register_form.elements['cpass'].value);
            data.append('profile',register_form.elements['profile'].files[0]);
            

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/login_register.php", true);

            xhr.onload = function(){
                if (this.responseText == 'pass_missmatch') {
                    alert('error','Password and Confirm Password do not match!');
                }
                else if (this.responseText == 'email_already') {
                    alert('error','Email is already registered!');
                }
                else if (this.responseText == 'phone_already') {
                    alert('error','Phone number is already registered!');
                }
                else if (this.responseText == 'inv_img') {
                    alert('error','Only JPG, WEBP & PNG images are allowed!');
                }
                else if (this.responseText == 'upd_failed') {
                    alert('error','Image upload failed!');
                }
                else if (this.responseText == 'mail_failed') {
                    alert('error','Cannot send confirmation email!  Server down!');
                }
                else if (this.responseText == 'ins_failed') {
                    alert('error','Registration failed!  Server down!');
                }
                else {
                    alert('success','Registration successful!  Please check your email for confirmation link.');
                    register_form.reset();
                }

            }

            xhr.send(data);
        });

        setActive();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7Mr0x7BUQOOnceIcNHDx5P4x5N8Fwp5cjQ1" crossorigin="anonymous"></script>
