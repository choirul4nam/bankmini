<style>
    body{
        height: 200mm;
        width: 80mm;
        page-break-after: always;
    }
    table tr td{
        font-size: 12px;
        padding-bottom: 10px;
        padding-top: 10px;
    }    
</style>
<table>
    <tr>
        <td colspan="3" align="center">
            <b>SMAN 1 WRINGIN ANOM</b>
        </td>
    </tr>
    <tr>
        <td><b>Nama</b></td>
        <td>:</td>
        <td><?= $query->namaTransaksi; ?></td>
    </tr>
    <tr>
        <td><b>Tanggal, Waktu</b></td>
        <td>:</td>
        <td><?= $query->tgl_update; ?></td>
    </tr>
    <tr>
        <td width="90px"><b>Kode Transaksi</b></td>
        <td>:</td>
        <td><?= $query->kodetransaksi; ?></td>
    </tr>
    <tr>
        <td><b>Keterangan</b></td>
        <td>:</td>
        <td><?= $query->keterangan; ?></td>
    </tr>
    <tr>
        <td><b>Nominal</b></td>
        <td>:</td>
        <td><?= 'Rp.' . number_format($query->nominal); ?></td>
    </tr>
    <tr>
        <td><b>Sisa Saldo</b></td>
        <td>:</td>
        <td>Rp. 0</td>
    </tr>
    <tr>
        <td colspan="3" align="right">
            Petugas
            <br>
            <?= $staf; ?>
        </td>
    </tr>
</table>
<script>
    window.print()
</script>
