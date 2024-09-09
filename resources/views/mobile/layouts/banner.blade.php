<div class="pt-5"></div>

<!-- Tiny Slider One Wrapper -->
<div class="tiny-slider-one-wrapper">
    <div class="tiny-slider-one">
        <!-- Single Hero Slide -->
        <div>
            <div class="single-hero-slide " style="background-image: url('assets/img/banner/d2.jpg')">
                <div class="h-100 d-flex align-items-center text-center">
                    
                </div>
            </div>
        </div>

        <!-- Single Hero Slide -->
        <div>
            <div class="single-hero-slide" style="background-image: url('assets/img/banner/d3.jpg')">
                <div class="h-100 d-flex align-items-center text-center">
                </div>
            </div>
        </div>

        <!-- Single Hero Slide -->
        <div>
            <div class="single-hero-slide" style="background-image: url('assets/img/banner/d1.jpg')">
                <div class="h-100 d-flex align-items-center text-center">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pt-3"></div>


<script>
    document.getElementById("searchbox").onkeyup = function() {
        var matcher = new RegExp(document.getElementById("searchbox").value, "gi");
        for (var i = 0; i < document.getElementsByClassName("product_div").length; i++) {
            if (matcher.test(document.getElementsByClassName("product-title")[i].innerHTML)) {
                document.getElementsByClassName("product_div")[i].style.display = "inline-block";
            } else {
                document.getElementsByClassName("product_div")[i].style.display = "none";
            }
        }
    }
</script>
