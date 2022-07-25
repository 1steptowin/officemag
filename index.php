<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница с уникальным кодом");


?>




<div class="center">
    <button class="get_discount">Получить скидку</button>
    <div class="result"></div>
</div>



<script>
    $(document).ready(function(){
        console.log('ready');

        $('.get_discount').on('click', function(){
           $.ajax({
                url: 'get_code.php',
                method: 'GET',
                success: function(msg){
                    console.log('success:');
                    console.log(msg);

                    if(msg.trim()=='Купон не найден'){
                        $('.result').text('Купон не найден');
                    }else{
                        $('.result').text(msg.trim());
                    }

                    
                },
                error: function(msg){
                    console.log('success:');
                    console.log(msg);
                }
           });
        });
    });
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
