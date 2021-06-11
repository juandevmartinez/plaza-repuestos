/**
 * Change shops on slide change
 * @param {int} currentSlide Index of the current Slide 
 */
function change_shops_on_slider(currentSlide){
    const vendors = document.querySelectorAll('.vendors-slider');
    vendors.forEach((vendor) => {
        vendor.classList.add('hide');

        let indexVendor = parseInt(vendor.getAttribute('data-slide-vendors'));
        
        if( indexVendor === currentSlide ){
            vendor.classList.toggle('hide');
        } 
    })
}

jQuery(document).ready(function($){
    const isHome = document.querySelector('.home');
    if( isHome ){
        // Checking if the API of rev slider exists
        let checkIsExist = setInterval(function(){
            if( revapi1 !== undefined ){

                clearInterval(checkIsExist);
                
                const slider = revapi1;
                slider.on('revolution.slide.onchange', function(event, data) {
 
                    // data.slideIndex   = Current Slide Index (starting with the number zero)
                    const currentSlide = data.slideIndex;
                    change_shops_on_slider(currentSlide)   
                });
            }
        }, 100);
        setTimeout(clearInterval, 10000, checkIsExist);
    }
});