<?php
    $services_to_show = array(
        array(
            "title" => "Service 1",
            "desc" => "Start and end in Tokio! With the In-depth Cultural tour Classic Tokio Mini Adventure, lorem ipsum dolor sit amet consectetuer adipiscing elit sed diam ",
            "price" => 110
        ),
        array(
            "title" => "Service 2",
            "desc" => "Start and end in Tokio! With the In-depth Cultural tour Classic Tokio Mini Adventure, lorem ipsum dolor sit amet consectetuer adipiscing elit sed diam ",
            "price" => 120
        ),
        array(
            "title" => "Service 3",
            "desc" => "Start and end in Tokio! With the In-depth Cultural tour Classic Tokio Mini Adventure, lorem ipsum dolor sit amet consectetuer adipiscing elit sed diam ",
            "price" => 130
        )
    );  
?>


<div class="tfsp-checkout-container">
    <div class="tfsp-checkout-popup">
        <div class="tfsp-before-popup-section">
            <div class="tfsb-popup-title">
                <h3>Services You May Like to Add</h3>
            </div>
            <div class="tfsp-checkout-popup-cross">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect x="0.5" y="0.5" width="23" height="23" rx="3.5" fill="#fdf9f3"></rect>
                        <path d="M12 11.1111L15.1111 8L16 8.88889L12.8889 12L16 15.1111L15.1111 16L12 12.8889L8.88889 16L8 15.1111L11.1111 12L8 8.88889L8.88889 8L12 11.1111Z" fill="#666D74"></path>
                        <rect x="0.5" y="0.5" width="23" height="23" rx="3.5" stroke="#fdf9f3"></rect>
                    </svg>
                </span>
            </div>
        </div>
            
        <div class="tfsp-checkout-popup-content">
            <!-- Popup Start -->
            <?php foreach($services_to_show as $key => $service): ?>
                <div class="tf-single-tour-extra tour-extra-single">
                    <label for="service<?php echo $key ?>">
                        <div class="tf-extra-check-box">
                            <input type="checkbox" value="0" data-title="Nam esse magnam nost" id="extra0" name="tf-tour-extra">
                            <span class="checkmark"></span>
                        </div>
                        <div class="tf-extra-content">
                            <h5> <?php echo $service["title"]; ?>                                                             
                                <span>
                                    <span class="woocommerce-Price-amount amount"><bdi>
                                        <span class="woocommerce-Price-currencySymbol">$</span>
                                        <?php echo $service["price"]; ?> </bdi>
                                    </span>
                                </span>
                            </h5>
                            <p><?php echo $service["desc"]; ?> </p>
                                                                                        
                        </div>
                    </label>
                </div>
            <?php endforeach;?>
            <!-- Popup End -->
        </div>
        <div class="popup-submit-button">Submit</div>
    </div>
</div>