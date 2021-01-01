<section id="content">
    <div id="googleMap" style="width:100%;height:380px;"></div>

    <div class="container">
        <div class="row">
            <div class="span8">
                <br>
                <h4>Universitas Teknologi Yogyakarta</h4>
                <p>
                    Universitas Teknologi Yogyakarta atau biasa disingkat UTY
                    adalah salah satu perguruan tinggi swasta terbaik yang berbentuk
                    universitas di Provinsi Daerah Istimewa Yogyakarta (DIY),
                    Universitas ini diselenggarakan oleh Yayasan "Dharma Bhakti IPTEK",
                    Bediri pada 23 Oktober 2002 dengan penggabungan tiga perguruan tinggi melalui
                    Surat Keterangan Menteri Pendidikan Nasional RI No 237/D/0/2002 tertanggal 23 Oktober 2002.
                </p>
                <p>
                    <b>Alamat:</b>
                </p>
                <p>
                    <b>Kampus 1:</b> Jalan Ringroad Utara, Jombor, Sleman 55285.
                </p>
                <p>
                    <b>Kampus 2:</b> Jalan Glagahsari No.63 Umbulharjo, Yogyakarta 55164.
                </p>
                <p>
                    <b>Kampus 3:</b> Jalan Prof. Dr. Soepomo, S.H. No.21 Janturan, Umbulharjo, Yogyakarta 55165.
                </p>
            </div>
            <div class="span4">
                <div class="clearfix"></div>
                <aside class="right-sidebar">

                    <div class="widget">
                        <br>
                        <h5 class="widgetheading">Informasi Kontak<span></span></h5>

                        <ul class="contact-info">
                            <li><label>Alamat :</label> Jalan Ringroad Utara, Jombor, Sleman 55285.<br /> Jakarta selatan - Indonesia</li>
                            <li><label>Telepon :</label> +62 274 623310</li>                            
                            <li><label>Email : </label> webmaster@uty.ac.id</li>
                        </ul>

                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
<script>
    function addMarker(peta, InfoWindow, info) {
        //membuat marker
        var infoWindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            position: InfoWindow,
            map: peta
        });

        bindInfoWindow(marker, peta, infoWindow, info);
    }

    function initialize() {
        var propertiPeta = {
            center: new google.maps.LatLng(-7.7474055, 110.3553979),
            zoom: 15,
            myTypeId: google.maps.MapTypeId.ROADMAP
        };

        var infoWindow = new google.maps.InfoWindow();

        var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

        var lokasi = new google.maps.LatLng(-7.7474055, 110.3553979);

        addMarker(peta, lokasi);
    }

    //event jendela diload
    var jendela = new google.maps.event.addDomListener(window, 'load', initialize);
</script>