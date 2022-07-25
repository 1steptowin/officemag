<?  require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");

    //Сначала надо динамически сгенерировать скидку. Рандомно (от 1 до 50%) задать величину скидки.
    //Потом взять ID только что созданной скидки, и этот ID указать при вызове \Bitrix\Sale\Internals\DiscountCouponTable::add



    $COUPON = CatalogGenerateCoupon();
    global $USER;
    $user_id = $USER->GetID();


    $arCouponFields = array(
        "DISCOUNT_ID" => 2,
        "ACTIVE" => "Y",
        "ONE_TIME" => "N",
        "COUPON" => $COUPON,
        "DATE_APPLY" => false
    );

    //$CID = CCatalogDiscountCoupon::Add($arCouponFields);
    $result = \Bitrix\Sale\Internals\DiscountCouponTable::add(array(
        'DISCOUNT_ID' => 2,
        'COUPON'      => $COUPON,
        'TYPE'        => \Bitrix\Sale\Internals\DiscountCouponTable::TYPE_ONE_ORDER,
        'MAX_USE'     => 1,
        'USER_ID'     => $user_id,
        'DESCRIPTION' => ''
    ));


    if (!$result->isSuccess())
    {
        $res =  $result->getErrorMessages();
    } else {
        $coupon_id = $result->getId();
        //echo $coupon_id;

        $arCoupon = CCatalogDiscountCoupon::GetByID((int)$coupon_id);
        //var_dump($arCoupon);

        if (empty($arCoupon))
        {
            ShowError('Купон не найден');
        }
        else
        {

            echo 'Код купона: '.$arCoupon['COUPON'];
        }
    }
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>