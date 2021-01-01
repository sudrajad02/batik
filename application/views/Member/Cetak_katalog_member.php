<title><?php echo $judul ?></title>
<table>
    <?php foreach ($toko as $tk) : ?>
        <tr>
            <td style="width:350px;height:330px" align="center">
                <?php
                $id_toko = $tk->id_toko;

                $query = $this->db->query("SELECT * FROM tb_foto_toko WHERE id_toko = '$id_toko' AND status_foto = 1")->row_array();
                $foto = $query['nama_foto'];

                $query_produk = $this->db->query("SELECT * FROM tb_produk WHERE id_toko = '$id_toko'")->result_array();
                ?>
                <img src="public/image/toko_batik/<?php echo $foto ?>" style="width:300px;height:250px" />
            </td>
            <td>
                <p>Nama Toko : <?php echo $tk->nama_toko ?></p>
                <p>Alamat Toko : <?php echo $tk->alamat_toko ?></p>
                <p>No Hp Toko : <?php echo $tk->no_hp_toko ?></p>
                <p>Email Toko : <?php echo $tk->email_toko ?></p>
                <p>Website Toko : <?php echo $tk->website_toko ?></p>
                <p>Hari Buka : <?php echo $tk->hari_buka . ' - ' . $tk->hari_tutup ?></p>
                <p>Jam Operasional : <?php echo $tk->jam_buka . ' - ' . $tk->jam_tutup ?></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
    <?php endforeach; ?>
</table>