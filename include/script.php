<script src="js/JQuery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        // For search bar
        $(document).on('click','.search',function(){
            $('.search-bar').addClass('search-bar-active')
        });
        $(document).on('click','.search-cancel',function(){
            $('.search-bar').removeClass('search-bar-active')
        });
        // For login logout
        $(document).on('click','.user',function(){
            $('.form').addClass('login-active')
        });
        $(document).on('click','.signup-btn',function(){
            $('.form').addClass('signup-active').removeClass('login-active')
        });
        $(document).on('click','.form-cancel',function(){
            $('.form').removeClass('login-active')
        });
        $(document).on('click','.signin-btn',function(){
            $('.form').addClass('login-active').removeClass('signup-active')
        });
        $(document).on('click','.form-cancel',function(){
            $('.form').removeClass('signup-active')
        });

        /* fixed navbar when scroll */
        $(window).scroll(function(){
            if($(document).scrollTop() > 50){
                $('.navigation').addClass('fix-nav');
            }
            else{
                $('.navigation').removeClass('fix-nav');
            }
        });
        /* for responsive-menu */
        $(document).ready(function(){
            $('.toggle').click(function(){
                $('.toggle').toggleClass('active')
                $('.navigation').toggleClass('active')
            })
        })
    </script>