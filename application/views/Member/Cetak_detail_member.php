<title><?php echo $judul ?></title>
<?php
$id_toko = $toko['id_toko'];

$query = $this->db->query("SELECT * FROM tb_foto_toko WHERE id_toko = '$id_toko' AND status_foto = 1")->row_array();
$foto = $query['nama_foto'];

$query_produk = $this->db->query("SELECT * FROM tb_produk WHERE id_toko = '$id_toko'")->result_array();
?>
<img src="public/image/toko_batik/<?php echo $foto ?>" style="width:100%;height:280px" />
<br /><br />
<table border="1">
    <tr>
        <td style="width: 160px">
            Nama Toko :
        </td>
        <td>
            <?php echo $toko['nama_toko'] ?>
        </td>
    </tr>
    <tr>
        <td>
            Alamat Toko :
        </td>
        <td>
            <?php echo $toko['alamat_toko'] ?>
        </td>
    </tr>
    <tr>
        <td>
            No Hp Toko :
        </td>
        <td>
            <?php echo $toko['no_hp'] ?>
        </td>
    </tr>
    <tr>
        <td>
            Email Toko :
        </td>
        <td>
            <?php echo $toko['email_toko'] ?>
        </td>
    </tr>
    <tr>
        <td>
            Deskripsi Toko :
        </td>
        <td>
            <?php echo $toko['deskripsi'] ?>
        </td>
    </tr>
    <tr>
        <td>
            Hari Buka Toko :
        </td>
        <td>
            <?php echo $toko['hari_buka'] . ' - ' . $toko['hari_tutup'] ?>
        </td>
    </tr>
    <tr>
        <td>
            Jam Operasional Toko :
        </td>
        <td>
            <?php echo $toko['jam_buka'] . ' - ' . $toko['jam_tutup'] ?>
        </td>
    </tr>
</table>
<b>
    <p>Produk Toko Batik</p>
</b>
<table border="1">
    <tr>
        <?php foreach ($query_produk as $pdk) : ?>
            <td align="center">
                <img src="public/image/produk_toko/<?php echo $pdk['foto_batik'] ?>" style="width:100px;height:100px" />
            </td>
        <?php endforeach; ?>
    </tr>
    <tr>
        <?php foreach ($query_produk as $pdk) : ?>
            <td align="center">
                <?php echo $pdk['nama_batik'] ?>
            </td>
        <?php endforeach; ?>
    </tr>
</table>
<!-- <table border="1">
    <?php foreach ($query_produk as $pdk) : ?>
        <tr>
            <td align="center">
                <img src="public/image/produk_toko/<?php echo $pdk['foto_batik'] ?>" style="width:100px;height:100px" />
            </td>
            <td align="center">
                <?php echo $pdk['nama_batik'] ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table> -->