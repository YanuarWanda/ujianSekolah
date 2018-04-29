<script type="text/javascript">
    $(document).ready(function(){
        $('#sidenav-off').on('click', function(){
            $('.sidebar').removeClass('on');
            $('.sidebar').addClass('off');
            
            $('.brand-name').fadeOut();
            
            $('.maincontent').removeClass('on');
            $('.maincontent').addClass('off');
            
            $('.sidebar-menu').removeClass('on');
            $('.sidebar-menu').addClass('off');
            
            $('.sidebar-menu-text').fadeOut();
            
            $(this).parent().fadeOut();
        }); 
        
        $('#sidenav-on').on('click', function(){
            $('.sidebar').removeClass('off');
            $('.sidebar').addClass('on');
            
            $('.brand-name').fadeIn(1000);
            
            $('.maincontent').removeClass('off');
            $('.maincontent').addClass('on');
            
            $('.sidebar-menu').removeClass('off');
            $('.sidebar-menu').addClass('on');
            
            $('.sidebar-menu-text').fadeIn(1000);
            
            $('#sidenav-off').parent().fadeIn(1000);
        });
        
        var $mobile_on = true;
        
        $('#sidenav-off-mobile').on('click', function(){
            if($mobile_on == false){    
                $('.rest-sidebar').slideUp(100);
                $('.maincontent').show();
                $mobile_on = true;
            }else if($mobile_on == true){
                $('.rest-sidebar').slideDown(100);
                $('.maincontent').hide();
                $mobile_on = false;
            }else{
                alert($mobile_on);
            }
        });
    });
</script>