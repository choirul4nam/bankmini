$('#provinsi').change(function () {
	if (this.value !== 'Pilih Provinsi') {
		$.get('http://localhost/bms/siswa/getkota/' + this.value, function (result) {
			let data = JSON.parse(result);
			$('#selectKota').html('');
			$('#selectKeca').html('');
			$('#selectKota').removeAttr('disabled');
			data.forEach(function (res) {
				$('#selectKota').append('<option class="optkota" value="' + res.id_kota + '">' + res.name_kota + '</option>')
			})
		});
	}
})

$('#selectKota').change(function () {
	if (this.value !== 'Pilih Kota') {
		$.get('http://localhost/bms/siswa/getKecamatan/' + this.value, function (result) {
			let data = JSON.parse(result);
			$('#selectKeca').html('');
			$('#selectKeca').removeAttr('disabled');
			data.forEach(function (res) {
				$('#selectKeca').append('<option value="' + res.id_kecamatan + '">' + res.kecamatan + '</option>')
			})
		});
	}
})

$('#siswaKelas').change(function () {
	let idKelas = this.value;
	if (this.value !== 'Pilih Kelas') {
		$.get('http://localhost/bms/siswa/getSiswaByKelas/' + this.value, function (result) {
			let data = JSON.parse(result);
			$('#dataSiswaKelas').html(' ');
			// $('#selectKeca').removeAttr('disabled');
			if (data.length === 0 || data === null || data === undefined) {
				$('#dataSiswaKelas').append('<tr><td colspan="7" align="center">Tidak Ada Data</td></tr>');
				$('.btn-grad').attr('disabled', 'disabled');
			} else {
				let i = 1;
				$('.btn-grad').removeAttr('disabled');
				$('.btn-grad').click(function () {
					if (confirm('Yakin')) {
						window.location.href = 'http://localhost/bms/siswa/export_process/' + idKelas;
					}
				})
				data.forEach(function (res) {
					$('#dataSiswaKelas').append('<tr><td>' + i + '</td><td>' + res.nis + '</td><td>' + res.namasiswa + '</td><td>' + res.alamat + '</td><td>' + res.jk + '</td><td>' + res.kelas + '</td><td>' + res.rfid + '</td></tr>');
					i++;
				})
			}
		});
	}
})

$('#btnUnCheck').hide()

$('#btnCheckAll').click(function () {
	$('.nisCheck').attr('checked', 'checked')
	$('#btnCheckAll').hide()
	$('#btnUnCheck').show()
})

$('#btnUnCheck').click(function () {
	$('.nisCheck').removeAttr('checked')
	$('#btnUnCheck').hide()
	$('#btnCheckAll').show()
})

$('#inputNominal').keyup(function (e) {
	this.value = formatRupiah(this.value, "Rp. ");
});
let edtNominal = $('.inputEdtNominal').val();
$('.inputEdtNominal').val(formatRupiah(edtNominal, "Rp. "))

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
	var number_string = angka.replace(/[^,\d]/g, "").toString(),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if (ribuan) {
		separator = sisa ? "." : "";
		rupiah += separator + ribuan.join(".");
	}

	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	$('#nominal').val(rupiah);
	return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}
