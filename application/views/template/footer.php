<footer>
	<strong>Development By &copy; 2020 <a href="https://hosterweb.co.id">HOSTERWEB INDONESIA</a>
</footer>
</div>
<!-- /.main-wrapper -->
</div>
<!-- ========== COMMON JS FILES ========== -->
<script src="<?php echo base_url() ?>assets/Theme/js/jquery/jquery-2.2.4.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/jquery-ui/jquery-ui.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/bootstrap/bootstrap.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/pace/pace.min.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/lobipanel/lobipanel.min.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/iscroll/iscroll.js">j</script>
<script src="<?php echo base_url() ?>assets/Theme/js/DataTables/DataTables-1.10.13/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/DataTables/DataTables-1.10.13/js/dataTables.bootstrap.js"></script>

<!-- ========== PAGE JS FILES ========== -->
<script src="<?php echo base_url() ?>assets/Theme/js/prism/prism.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/waypoint/waypoints.min.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/counterUp/jquery.counterup.min.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/amcharts/amcharts.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/amcharts/serial.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/amcharts/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/js/amcharts/plugins/export/export.css" type="text/css"
	  media="all"/>
<script src="<?php echo base_url() ?>assets/Theme/js/amcharts/themes/light.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/toastr/toastr.min.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/icheck/icheck.min.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/bootstrap-tour/bootstrap-tour.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/select2/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/chartjs/Chart.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/chartjs/utils.js"></script>
<!-- <script src="<?php echo base_url() ?>assets/Theme/js/chartjs/globalchartjs.js"></script> -->

<!-- ========== THEME JS ========== -->
<script src="<?php echo base_url() ?>assets/Theme/js/main.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/production-chart.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/traffic-chart.js"></script>
<script src="<?php echo base_url() ?>assets/Theme/js/task-list.js"></script>
<!-- <script src="<?php echo base_url() ?>assets/Theme/js/script.js"></script> -->
<script>
	let baseUrl = "<?php echo base_url() ?>"
	console.log(baseUrl)
	$.get(baseUrl+'welcome/getTransaksiChart', function(res){		
		let siswa = []
		let hasil = JSON.parse(res);
		let dataSiswa = hasil.dataSiswa
		let dataTransaksi = hasil.dataTransaksi
		let dataTglTransaksi = [];
		let transaksiDebet = [];
		let transaksiKredit = [];
		for(let i = 0; i < dataTransaksi.length; i++){
			dataTglTransaksi.push(dataTransaksi[i].tgl);
			if(dataTransaksi[i].tipe == 'debet'){
				transaksiDebet.push(dataTransaksi[i].nominal);
			}
			if(dataTransaksi[i].tipe == 'kredit'){
				transaksiKredit.push(dataTransaksi[i].nominal);
			}
		}
		// console.log(dataTglTransaksi)
		for(let i = 0; i < dataSiswa.length; i++){
			siswa.push({kelas : dataSiswa[i].kelas, jumlah : dataSiswa[i].jmlsiswa, color : '#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6) });
		}
		var chart = AmCharts.makeChart("chart1", {
                  "type": "serial",
                  "theme": "light",
                  "fontFamily": "Poppins",
                  "marginRight": 70,
                  "dataProvider": siswa,
                  "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left",
                    "title": "Data Siswa"
                  }],
                  "startDuration": 1,
                  "graphs": [{
                    "balloonText": "<b>[[category]]: [[value]]</b>",
                    "fillColorsField": "color",
                    "fillAlphas": 0.9,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "jumlah"
                  }],
                  "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                  },
                  "categoryField": "kelas",
                //   "categoryAxis": {
                //     "gridPosition": "start",
                //     "labelRotation": 45
                //   },
                  "export": {
                    "enabled": true
				}
			});
		
		var config = {
            type: 'line',
            data: {
                labels: dataTglTransaksi,
                datasets: [{
                    label: "Kredit",
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: transaksiKredit,
                    fill: false,
                }, {
                    label: "Debet",
                    fill: false,
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: transaksiDebet,
                }]
            },
            options: {
                responsive: true,
                fontFamily: 'Poppins',
                title:{
                    display:false
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                    fontFamily: 'Poppins',
                },
                hover: {
                    mode: 'nearest',
                    intersect: true,
                    fontFamily: 'Poppins',
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Per Hari',
                            fontFamily: 'Poppins',
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Data Transaksi ',
                            fontFamily: 'Poppins',
                        }
                    }]
                }
            }
		};		
		var ctxline = document.getElementById("line").getContext("2d");
		window.myLine = new Chart(ctxline, config);					
		
		
	})	
		
	$(".js-states").select2();

	$(".js-states-limit").select2({
		maximumSelectionLength: 2
	});

	$(".js-states-hide").select2({
		minimumResultsForSearch: Infinity
	});

	$('#tableLulus').DataTable();

	$('#table-user').DataTable();

	$('#upClass-table').DataTable()

	// let t = $('#dataTableTransaksi').DataTable({
	// 	"order": [[1, "desc"]],
	// 	'scrollX': true,
	// 	render: function (data, type, row, meta) {
	// 		return meta.row + meta.settings._iDisplayStart + 1;
	// 	}
	// });

	$(document).ready(function() {
		var t = $('#dataTableTransaksi').DataTable({
			"columnDefs": [{
				"searchable": false,
				"orderable": false,
				"targets": 0
			}],
			"order": [
				[1, 'DESC']
			],
			"sScrollX": "100%",
			"sScrollXInner": "110%",
			"bScrollCollapse": true,
			"responsive": true,
		});

		t.on('order.dt search.dt', function() {
			t.column(0, {
				search: 'applied',
				order: 'applied'
			}).nodes().each(function(cell, i) {
				cell.innerHTML = i + 1;
			});
		}).draw();
	});

	$('#dataTableSiswa').DataTable({
		'scrollX': true,
		'sort': false
	});

	$('#dataSiswaIndex').DataTable({
		"order": [
			[3, "desc"]
		],
		'scrollX': true,
		'sort': false
	});

	$('input.blue-style').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue'
	});

	$('input.green-style').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green'
	});

	$('input.red-style').iCheck({
		checkboxClass: 'icheckbox_square-red',
		radioClass: 'iradio_square-red'
	});

	$('input.flat-black-style').iCheck({
		checkboxClass: 'icheckbox_flat',
		radioClass: 'iradio_flat'
	});

	$('input.line-style').each(function() {
		var self = $(this),
			label = self.next(),
			label_text = label.text();

		label.remove();
		self.iCheck({
			checkboxClass: 'icheckbox_line-blue',
			radioClass: 'iradio_line-blue',
			insert: '<div class="icheck_line-icon"></div>' + label_text
		});
	});

	$("#tb_tipeuser").DataTable()

	$('#tb_staff').DataTable({
		"scrollX": true
	});

	$('#tb_histori').DataTable({
		// 'scrollX' : true,
		"sScrollX": "100%",
		"sScrollXInner": "110%",
		"bScrollCollapse": true,
		"responsive": true,
		"searching": false,
		"paging": false,
		"bInfo": false,
		// "sScrollX": "100%",
		// "sScrollXInner": "110%",
	});

	$('#tb_bp').DataTable({
		"scrollY": "170px",
		"scrollX": true,
		"scrollCollapse": true,
		"searching": false,
		"paging": false,
	});
	// if(transaksi == true){
	//     let interval = setInterval(() => {
	//         if($(".selectJS").data("select2").dropdown.$search.val() != ''){
	//             getDataByRfid($(".selectJS").data("select2").dropdown.$search.val())
	//             $(".selectJS").data("select2").dropdown.$search.val('')
	//             clearInterval(interval)
	//         }
	//     }, 500);
	// }

	function getDataByRfid(rfid) {
		// console.log(rfid)
		$('#box-transaksi').html('')
		// $('#id_customer').val(rfid)
		let tipe = $('.tipeuserAdd option:selected').html()
		$.get(baseUrl + 'transaksi/getHistoriTransaksiByRfid?id=' + rfid + '&tipe=' + $('.tipeuserAdd').val(), function(result) {
			let data = JSON.parse(result)
			// console.log(result)
			// console.log(data)
			if (data.length != 0) {
				let no = 1;
				data.forEach(function(res) {
					$('#box-transaksi').append(`<tr>
                                                    <td><b>` + no++ + `. </b></td> 
                                                    <td>` + res.tgl_update + `</td>
                                                    <td><b>` + res.keterangan + `</b></td>
                                                    <td>` + formatRupiah(res.nominal, 'Rp. ') + `</td>
                                                    <td>` + (res.debet == tipe ? 'Debet' : '')(res.kredit == tipe ? 'Kredit' : '') + `</td>
                                                </tr>`)
				})
				$.get(baseUrl + 'siswa/getSiswa', function(result) {
					let siswa = JSON.parse(result);
					// console.log(data)
					$('.cusName').html('');
					$('.cusName').removeAttr('disabled');
					$('.cusName').append('<option value="">Pilih Nama</option>')
					siswa.forEach(function(res) {
						if (res.rfid == rfid) {
							$('#id_customer').val(res.nis)
							$('.cusName').append('<option value="' + res.nis + '" selected>' + res.namasiswa + ' ( ' + res.nis + ' )</option>')
						} else {
							$('.cusName').append('<option value="' + res.nis + '">' + res.namasiswa + ' ( ' + res.nis + ' )</option>')
						}
					})
				});
				// $.get(baseUrl+'mtransaksi/getMTransaksiSiswa/siswa', function (result) {
				//     // let data = JSON.parse(result);
				//     // console.log(data)
				//     $('.kategori').html('');
				//     $('.kategori').removeAttr('disabled');
				//     $('.kategori').append('<option value="">Pilih Transaksi</option>')
				//     data.forEach(function (res) {
				//         $('.kategori').append('<option value="' + res.id_mastertransaksi + '">' + res.kategori + '</option>')
				//     })
				// });
			} else {
				$('#box-transaksi').append(`<tr>
                                                <td colspan="4">Tidak Ada Transaksi</td>
                                            </tr>`)
			}
		});
	}

	$("#tb_tahunakademik").DataTable()
	// $("#tb_staff").DataTable();

	$(".s_provinsi").change(function() {
		$.get(baseUrl + "staff/getkota/" + this.value, function(result) {
			let data = JSON.parse(result);
			$(".s_kota").html('<option>Pilih kota</option>')
			$(".s_kota").removeAttr('disabled')
			$(".s_kecamatan").html('<option>Pilih Kecamatan</option>')
			data.forEach(function(dataKota) {
				$(".s_kota").append('<option value="' + dataKota.id_kota + '">' + dataKota.name_kota + '</option>')
			})
		})
	});

	$(".s_kota").change(function() {
		$.get(baseUrl + "staff/getkecamatan/" + this.value, function(result) {
			console.log(result)
			let data = JSON.parse(result);
			$(".s_kecamatan").removeAttr('disabled')
			$(".s_kecamatan").html('<option>Pilih Kecamatan</option>')

			data.forEach(function(dataKecamatan) {
				$(".s_kecamatan").append('<option value="' + dataKecamatan.id_kecamatan + '">' + dataKecamatan.kecamatan + '</option>')
			})
		})
	})

	$('#debet').change(function() {
		// let kdval = $("#kredit").val();			
		// if(kdval === 'salah'){
		// 	console.log(this.value)
		// 	$('#kredit').html('')
		// 	if(this.value !== 'salah') {
		// 		$.get( baseUrl+'tipeuser/getTipeUser/'+this.value ,function(res){
		// 			let data = JSON.parse(res)
		// 			console.log(data)
		// 			$('#kredit').append('<option value="salah">Pilih</option>')
		// 			data.forEach(function(row){				
		// 				$('#kredit').append('<option value="'+row.id_tipeuser+'">'+row.tipeuser+'</option>')
		// 			})
		// 		})				
		// 	}else{
		// 		$.get( baseUrl+'tipeuser/getTipeUserAll',function(res){
		// 			let data = JSON.parse(res)
		// 			console.log(data)
		// 			$('#kredit').append('<option value="salah">Pilih</option>')
		// 			data.forEach(function(row){				
		// 				$('#kredit').append('<option value="'+row.id_tipeuser+'">'+row.tipeuser+'</option>')
		// 			})
		// 		})				
		// 	}
		// }else{			
		// 	if(this.value === 'salah'){				
		// 		$('#kredit').html('')
		// 		$.get( baseUrl+'tipeuser/getTipeUserAll',function(res){
		// 			let data = JSON.parse(res)
		// 			console.log(data)
		// 			$('#kredit').append('<option value="salah">Pilih</option>')
		// 			data.forEach(function(row){				
		// 				$('#kredit').append('<option value="'+row.id_tipeuser+'">'+row.tipeuser+'</option>')
		// 			})
		// 		})							
		// 	}
		// }
		// console.log($(this).val())
		// if ($(this).val() === 'siswa') {
		// 	// $('#kredit').html('')
		// 	if ($('#kredit').val() === 'salah') {
		// 		$('#kredit').html('')
		// 		$('#kredit').append('<option value="salah">Pilih</option>')
		// 		$('#kredit').append('<option value="koperasi">Koperasi</option>')
		// 		$('#kredit').append('<option value="staf">Staf</option>')
		// 	} else if ($('#kredit').val() === 'siswa') {
		// 		$('#kredit').html('')
		// 		$('#kredit').append('<option value="salah">Pilih</option>')
		// 		$('#kredit').append('<option value="koperasi">Koperasi</option>')
		// 		$('#kredit').append('<option value="staf">Staf</option>')
		// 	} else if ($('#kredit').val() === 'staf') {
		// 		$('#kredit').html('')
		// 		$('#kredit').append('<option value="salah">Pilih</option>')
		// 		$('#kredit').append('<option value="koperasi">Koperasi</option>')
		// 		$('#kredit').append('<option value="siswa">Siswa</option>')
		// 	} else if ($('#kredit').val() === 'koperasi') {
		// 		$('#kredit').html('')
		// 		$('#kredit').append('<option value="salah">Pilih</option>')
		// 		$('#kredit').append('<option value="staf">Staf</option>')
		// 		$('#kredit').append('<option value="siswa">Siswa</option>')
		// 	}
		// }else if ($(this).val() === 'koperasi') {
		// 	if ($('#kredit').val() === 'salah') {
		// 		$('#kredit').html('')
		// 		$('#kredit').append('<option value="salah">Pilih</option>')
		// 		$('#kredit').append('<option value="siswa">siswa</option>')
		// 		$('#kredit').append('<option value="staf">Staf</option>')
		// 	} else if ($('#kredit').val() === 'siswa') {
		// 		$('#kredit').html('')
		// 		$('#kredit').append('<option value="salah">Pilih</option>')
		// 		$('#kredit').append('<option value="koperasi">Koperasi</option>')
		// 		$('#kredit').append('<option value="staf">Staf</option>')
		// 	} else if ($('#kredit').val() === 'staf') {
		// 		$('#kredit').html('')
		// 		$('#kredit').append('<option value="salah">Pilih</option>')
		// 		$('#kredit').append('<option value="koperasi">Koperasi</option>')
		// 		$('#kredit').append('<option value="siswa">Siswa</option>')
		// 	} else if ($('#kredit').val() === 'koperasi') {
		// 		$('#kredit').html('')
		// 		$('#kredit').append('<option value="salah">Pilih</option>')
		// 		$('#kredit').append('<option value="staf">Staf</option>')
		// 		$('#kredit').append('<option value="siswa">Siswa</option>')
		// 	}
		// }else if ($(this).val() === 'staf'){
		// 	if ($('#kredit').val() === 'salah') {
		// 		$('#kredit').html('')
		// 		$('#kredit').append('<option value="salah">Pilih</option>')
		// 		$('#kredit').append('<option value="siswa">siswa</option>')
		// 		$('#kredit').append('<option value="koperasi">Koperasi</option>')
		// 	} else if ($('#kredit').val() === 'siswa') {
		// 		$('#kredit').html('')
		// 		$('#kredit').append('<option value="salah">Pilih</option>')
		// 		$('#kredit').append('<option value="koperasi">Koperasi</option>')
		// 		$('#kredit').append('<option value="staf">Staf</option>')
		// 	} else if ($('#kredit').val() === 'staf') {
		// 		$('#kredit').html('')
		// 		$('#kredit').append('<option value="salah">Pilih</option>')
		// 		$('#kredit').append('<option value="koperasi">Koperasi</option>')
		// 		$('#kredit').append('<option value="siswa">Siswa</option>')
		// 	} else if ($('#kredit').val() === 'koperasi') {
		// 		$('#kredit').html('')
		// 		$('#kredit').append('<option value="salah">Pilih</option>')
		// 		$('#kredit').append('<option value="staf">Staf</option>')
		// 		$('#kredit').append('<option value="siswa">Siswa</option>')
		// 	}
		// }else {
		// 	$('#kredit').html('<option value="salah">Pilih</option><option value="siswa">siswa</option><option value="koperasi">Koperasi</option> <option value="staf">Staf</option>')
		// }					
	})

	$('#kredit').change(function() {
		// let dbval = $('#debet').val();
		// if(dbval ===  'salah'){
		// 	if(this.value !== 'salah'){
		// 		$.get( baseUrl+'tipeuser/getTipeUser/'+this.value ,function(res){
		// 			$('#debet').html('')	
		// 			let data = JSON.parse(res)
		// 			console.log(data)
		// 			$('#debet').html('<option value="salah">Pilih</option>')
		// 			data.forEach(function(row){				
		// 				$('#debet').append('<option value="'+row.id_tipeuser+'">'+row.tipeuser+'</option>')
		// 			})
		// 		})
		// 	}
		// }
		// if ($(this).val() === 'siswa') {
		// 	if ($('#debet').val() === 'salah') {
		// 		$('#debet').html('')
		// 		$('#debet').append('<option value="salah">Pilih</option>')
		// 		$('#debet').append('<option value="koperasi">Koperasi</option>')
		// 		$('#debet').append('<option value="staf">Staf</option>')
		// 	} else if ($('#debet').val() === 'siswa') {
		// 		$('#debet').html('')
		// 		$('#debet').append('<option value="salah">Pilih</option>')
		// 		$('#debet').append('<option value="koperasi">Koperasi</option>')
		// 		$('#debet').append('<option value="staf">Staf</option>')
		// 	} else if ($('#debet').val() === 'staf') {
		// 		$('#debet').html('')
		// 		$('#debet').append('<option value="salah">Pilih</option>')
		// 		$('#debet').append('<option value="koperasi">Koperasi</option>')
		// 		$('#debet').append('<option value="siswa">Siswa</option>')
		// 	} else if ($('#debet').val() === 'koperasi') {
		// 		$('#debet').html('')
		// 		$('#debet').append('<option value="salah">Pilih</option>')
		// 		$('#debet').append('<option value="staf">Staf</option>')
		// 		$('#debet').append('<option value="siswa">Siswa</option>')
		// 	}
		// } else if ($(this).val() === 'koperasi') {
		// 	if ($('#debet').val() === 'Pilih' || $('#debet').val() === null || $('#debet').val() === ' ') {
		// 		$('#debet').html('<option>Pilih</option><option value="siswa">siswa</option>')
		// 	} else if ($('#debet').val() === 'koperasi') {
		// 		$('#debet').html('<option>Pilih</option><option value="siswa">siswa</option>')
		// 	}
		// } else {
		// 	$('#debet').html('<option>Pilih</option><option value="siswa">siswa</option><option value="koperasi">Koperasi</option>')
		// }
	})

	$('#blnkas').change(function() {
		let dbet = 0
		let krdii = 0
		let sldo = 0
		$.get(baseUrl + "kasumum/dkkkk/" + this.value, function(result) {
			let data = JSON.parse(result);
			dbet = data['dbet']
			krdii = data['krdi']
			sldo = data['sldo']
		})
		$.get(baseUrl + "kasumum/recapKas/" + this.value, function(result) {
			$("#dataKas").html('')
			let data = JSON.parse(result);
			if (data.length == 0) {
				$("#dataKas").append(`<tr>
                    <td colspan="5"><center>Data Kosong</center></td>
                </tr>`)
			} else {
				console.log(data)
				data.forEach(function(dataKasKeluar) {
					let dateee = new Date(dataKasKeluar[0])
					let tgltransaksii = dateee.getDate() + ' - ' + (dateee.getMonth() + 1) + ' - ' + dateee.getFullYear()
					let kode = dataKasKeluar[3]
					let ketkode = kode.substring(0, 2)
					let debet = 0
					let kredit = 0
					if (ketkode === 'KK') {
						debet = 'Rp. 0'
						kredit = formatRupiah(dataKasKeluar[2].toString(), 'Rp. ')
					} else if (ketkode == 'KM') {
						kredit = 'Rp. 0'
						debet = formatRupiah(dataKasKeluar[2].toString(), 'Rp. ')
					}

					$("#dataKas").append(`<tr>
                    <td>` + tgltransaksii + `</td>
                    <td>` + dataKasKeluar[1] + `</td>
                    <td>` + debet + `</td>
                    <td>` + kredit + `</td>
                    <td>` + formatRupiah(dataKasKeluar[4].toString(), 'Rp. ') + `</td>
                </tr>`)
				})
				$("#dataKas").append(`<tr>
                    <td></td>
                    <td>Saldo Akhir</td>
                    <td>` + formatRupiah(dbet.toString(), 'Rp. ') + `</td>
                    <td>` + formatRupiah(krdii.toString(), 'Rp. ') + `</td>
                    <td>` + formatRupiah(sldo.toString(), 'Rp. ') + `</td>
                </tr>`)
			}
		})
	})

	$('#neraca').change(function() {
		$('#pm').removeAttr('checked')
		$('#lr').removeAttr('checked')
		$('#pm').removeAttr('required')
		$('#lr').removeAttr('required')
	})

	$('#pm').change(function() {
		$('#neraca').removeAttr('checked')
		$('#lr').removeAttr('checked')
		$('#neraca').removeAttr('required')
		$('#lr').removeAttr('required')
	})

	$('#lr').change(function() {
		$('#neraca').removeAttr('checked')
		$('#pm').removeAttr('checked')
		$('#neraca').removeAttr('required')
		$('#pm').removeAttr('required')
	})

	// function toggle(source) {
	//     var checkboxes = document.querySelectorAll('input[type="checkbox"]');
	//     for (var i = 0; i < checkboxes.length; i++) {
	//         if (checkboxes[i] != source)
	//             checkboxes[i].checked = source.checked;
	//     }

	//     $('#saldo').html('<h3 class="ml-5 mt-5 mr-5 mb-5" id="saldo">Saldo = ' + formatRupiah(saldo, 'Rp. ') + '</h3>')
	// })

	// })

	function toggle(source) {
		var checkboxes = document.querySelectorAll('input[type="checkbox"]');
		for (var i = 0; i < checkboxes.length; i++) {
			if (checkboxes[i] != source)
				checkboxes[i].checked = source.checked;
		}
	}

	function embuh() {
		var embuha = document.getElementById('kodeformat1').value;
		if (embuha == 'huruf') {
			document.getElementById('texthuruf1').style.visibility = 'visible';
			// document.getElementById('texthuruf1').value = embuha;
		} else {
			document.getElementById('texthuruf1').style.visibility = 'hidden';

		}
	}

	function embuhb() {
		var embuhtext = document.getElementById('format2').value;
		if (embuhtext == 'huruf') {
			document.getElementById('texthuruf2').style.visibility = 'visible';
		} else {
			document.getElementById('texthuruf2').style.visibility = 'hidden';

		}
	}

	function embuhc() {
		var embuhtext3 = document.getElementById('format3').value;
		if (embuhtext3 == 'huruf') {
			document.getElementById('texthuruf3').style.visibility = 'visible';
		} else {
			document.getElementById('texthuruf3').style.visibility = 'hidden';
		}
		// document.getElementById('texthuruf3').value=embuhtext3;
	}

	function embuhhub() {
		var a = document.getElementById('kodeformat1').value;
		var b = document.getElementById('format2').value;
		var c = document.getElementById('format3').value;
		var d = document.getElementById('penghubung').value;
		var e = document.getElementById('texthuruf1').value;
		var f = document.getElementById('texthuruf2').value;
		var g = document.getElementById('texthuruf2').value;
		if (a == "huruf") {
			var a = e;
		}
		if (b == "huruf") {
			var b = f;
		}
		if (c == "huruf") {
			var c = g;
		}
		document.getElementById('final').value = a + d + b + d + c;

		document.getElementById('kodetransaksi').value = a + d + b + d + c;
		$('#btnsimpankodekorwil').click(function() {
			$('.close').click();
		})
		// var embuhhuba = document.getElementById('penghubung').value;
		// document.getElementById('final').value= a+b;
	}

	$('#tb_import').DataTable({
		scrollY: '300px',
		paging: false,
	});

	$('#file').hide();

	$('#file').change(function() {
		$('#filename').html($(this)[0].files[0]['name'])
		// console.log()
	})

	// $('#warning').css("display", "none")

	$('.tipeuserAdd').change(function() {
		$('#box-transaksi').html('')
		if ($(this).val() != 'salah') {
			$('#saldoBox').removeAttr('data-saldo')
			$('#saldoBox').html('Rp. 0')
			$('#sisasaldo').val('')
			$('#warning').css("display", "none")
			$('#tipeTransaksi').val()
			$('.cusName').html('');
			$('.cusName').attr('disabled', 'disabled');
			$('.cusName').append('<option value="">Pilih Nama</option>')
			$('.kategori').html('');
			$('.kategori').attr('disabled', true);
			$('.kategori').append('<option value="salah">Pilih Transaksi</option>')
			$('.inpt').attr('disabled', 'disabled')
			$('.btnAdd').attr('disabled', true)
			$('#id_jenistransaksi').val('')
			$('#kode').val('')
			$('#kode_transaksi').val('')
			$('#keterangan').val('')
			$('.nominalInp').val('')
			if (parseInt($(this).val()) == 1) {
				$.get(baseUrl + 'staff/getStaff', function(result) {
					let data = JSON.parse(result);
					// console.log(data)
					$('.cusName').html('');
					$('.cusName').removeAttr('disabled');
					$('.cusName').append('<option value="">Pilih Nama</option>')
					data.forEach(function(res) {
						$('.cusName').append('<option value="' + res.id_staf + '">' + res.nama + ' (' + res.nopegawai + ')</option>')
					})
				});
				$.get(baseUrl + 'mtransaksi/getMTransaksiStaf/koperasi', function(result) {
					let data = JSON.parse(result);
					// console.log(data)
					$('.kategori').html('');
					$('.kategori').removeAttr('disabled');
					$('.kategori').append('<option value="salah">Pilih Transaksi</option>')
					data.forEach(function(res) {
						$('.kategori').append('<option value="' + res.id_mastertransaksi + '">' + res.kategori + '</option>')
					})
				});

			} else {
				$.get(baseUrl + 'siswa/getSiswa', function(result) {
					let data = JSON.parse(result);
					// console.log(data)
					$('.cusName').html('');
					$('.cusName').removeAttr('disabled');
					$('.cusName').append('<option value="">Pilih Nama</option>')
					data.forEach(function(res) {
						$('.cusName').append('<option value="' + res.nis + '">' + res.namasiswa + ' ( ' + res.nis + ' )</option>')
					})
				});
				$.get(baseUrl + 'mtransaksi/getMTransaksiSiswa/siswa', function(result) {
					let data = JSON.parse(result);
					// console.log(data)
					$('.kategori').html('');
					$('.kategori').removeAttr('disabled');
					$('.kategori').append('<option value="salah">Pilih Transaksi</option>')
					data.forEach(function(res) {
						$('.kategori').append('<option value="' + res.id_mastertransaksi + '">' + res.kategori + '</option>')
					})
				});
			}
		} else {
			$('.cusName').html('');
			$('.cusName').attr('disabled', 'disabled');
			$('.cusName').append('<option value="">Pilih Nama</option>')
			$('.kategori').html('');
			$('.kategori').attr('disabled', true);
			$('.kategori').append('<option value="salah">Pilih Transaksi</option>')
			$('#tipeTransaksi').val()
			$('.inpt').attr('disabled', 'disabled')
			$('.btnAdd').attr('disabled', true)
			$('#id_jenistransaksi').val('')
			$('#kode').val('')
			$('#kode_transaksi').val('')
			$('#keterangan').val('')
			$('.nominalInp').val('')
		}
		$('#usertipe').val($('.tipeuserAdd').val())
	})


	$('.kategori').change(function() {
		if (this.value != 'salah') {
			$('.inpt').removeAttr('disabled')
			$.get(baseUrl + 'mtransaksi/detailTransaksi/' + this.value, function(result) {
				let data = JSON.parse(result);
				$.get(baseUrl + 'transaksi/getNewKode/' + data.kodetransaksi, function(res) {
					$('#kode').val(res)
					$('#kode_transaksi').val(res)
				})
				$('#id_jenistransaksi').val(data.id_mastertransaksi)
				$('#keterangan').val(data.deskripsi)
				$('#nominal').val(parseInt(data.nominal))
				$('.nominalInp').val(formatRupiah(data.nominal, "Rp. "))
				// $('.nominalInp').attr('nominal', data.nominal)
				let saldo = $('#saldoBox').attr('data-saldo')
				if (data.kredit == 'siswa') {
					$('.nominalInp').attr('tipe-kredit', data.kredit)
					$('.btnAdd').removeAttr('disabled')
					$('#warning').css("display", "none")
					$('#tipeTransaksi').val('kredit')
					$('.nominalInp').attr('disabled', false)
					$('.nominalInp').css('background', '#f7f774')
				} else if (data.debet == 'siswa') {
					$('#tipeTransaksi').val('debet')
					$('.nominalInp').attr('tipe-debet', data.debet)
					$('.nominalInp').attr('disabled', true)
					$('.nominalInp').css('background', '#d4d4ba')
					if (data.nominal > parseInt(saldo)) {
						$('#warning').css("display", "block")
						$('.btnAdd').attr('disabled', 'disabled')
					} else {
						$('#warning').css("display", "none")
						$('.btnAdd').removeAttr('disabled')
					}
				}
				// if(data.kredit == 'koperasi'){
				//     $('.nominalInp').attr('tipe-kredit', data.kredit)
				//     $('.btnAdd').removeAttr('disabled')
				//     $('#warning').hide()
				//     $('#tipeTransaksi').val('kredit')
				if (data.debet == 'koperasi') {
					$('#tipeTransaksi').val('debet')
					$('.nominalInp').attr('tipe-debet', data.debet)
					$('.nominalInp').attr('disabled', true)
					$('.nominalInp').css('background', '#d4d4ba')
					if (data.nominal > parseInt(saldo)) {
						$('#warning').css("display", "block")
						$('.btnAdd').attr('disabled', 'disabled')
					} else {
						$('#warning').css("display", "none")
						$('.btnAdd').removeAttr('disabled')
					}
				} else if (data.debet == '' && data.kredit == 'koperasi') {
					$('#tipeTransaksi').val('kredit')
					$('.nominalInp').attr('tipe-debet', data.debet)
					$('.nominalInp').attr('tipe-kredit', data.kredit)
					$('.nominalInp').attr('disabled', false)
					$('.nominalInp').css('background', '#f7f774')
					if (data.nominal > parseInt(saldo)) {
						$('#warning').css("display", "block")
						$('.btnAdd').attr('disabled', 'disabled')
					} else {
						$('#warning').css("display", "none")
						$('.btnAdd').removeAttr('disabled')
					}
				}
			});
		} else {
			$('.inpt').attr('disabled', 'disabled')
			$('.kategori').removeAttr('disabled')
			$('.cusName').removeAttr('disabled')
			$('.btnAdd').attr('disabled', true)
			$('#id_jenistransaksi').val('')
			$('#kode').val('')
			$('#kode_transaksi').val('')
			$('#keterangan').val('')
			$('.nominalInp').val('')
		}
	})

	$('.nominalInp').keyup(function() {
		this.value = formatRupiah(this.value, "Rp. ");
		let saldo = $('#saldoBox').attr('data-saldo')
		let kredit = $('.nominalInp').attr('tipe-kredit')
		let debet = $('.nominalInp').attr('tipe-debet')
		let nominal = $(this).val();
		var one = nominal.slice(4, nominal.length);
		var res = one.replace(/[^\w\s]/gi, '');
		console.log(kredit)
		console.log(debet)
		if (kredit == 'siswa') {
			// console.log("siswa")
			$('#warning').css("display", "none")
			$('.btnAdd').removeAttr('disabled')
		} else if (debet == 'siswa') {
			// console.log("debet Siswa")
			if (parseInt(res) <= parseInt(saldo)) {
				// console.log('bisa transaksi')
				$('#warning').css("display", "none")
				$('.btnAdd').removeAttr('disabled')
			} else if (parseInt(res) >= parseInt(saldo)) {
				// console.log('saldo tidak cukup')
				// console.log('Nominal 4'+res)
				// console.log('saldo 4'+saldo)
				$('#warning').css("display", "block")
				$('.btnAdd').attr('disabled', true)
			}
		}
		if (debet == 'koperasi') {
			if (parseInt(res) <= parseInt(saldo)) {
				// console.log('bisa transaksi')
				$('#warning').css("display", "none")
				$('.btnAdd').removeAttr('disabled')
			} else if (parseInt(res) >= parseInt(saldo)) {
				// console.log('saldo tidak cukup')
				// console.log('Nominal 4'+res)
				// console.log('saldo 4'+saldo)
				$('#warning').css("display", "block")
				$('.btnAdd').attr('disabled', true)
			}
		} else if (debet == '' && kredit == 'koperasi') {
			$('#warning').css("display", "none")
			$('.btnAdd').removeAttr('disabled')
		}
		$("#nominal").val(res);
		// console.log(res)
		// console.log(one)
	})

	if ($('#editTransaksi').val() == 'edit') {
		getCustomer()
	}

	$('#confirmTable').hide()

	function getCustomer() {
		let customer = $('#id_customer').val()
		if ($('#usertipe').val() == 'siswa') {
			$.get(baseUrl + 'siswa/getSiswa', function(result) {
				let data = JSON.parse(result);
				// console.log(data)
				$('.cusName').html('');
				$('.cusName').removeAttr('disabled');
				$('.cusName').append('<option value="">Pilih Nama</option>')
				data.forEach(function(res) {
					$('.cusName').append('<option value="' + res.id_staf + '">' + res.nama + '</option>')
				})
			});
			$.get(baseUrl + 'mtransaksi/getMTransaksiStaf/koperasi', function(result) {
				let data = JSON.parse(result);
				// console.log(data)
				$('.kategori').html('');
				$('.kategori').removeAttr('disabled');
				$('.kategori').append('<option value=" ">Pilih Transaksi</option>')
				data.forEach(function(res) {
					$('.kategori').append('<option value="' + res.id_mastertransaksi + '">' + res.kategori + '</option>')
				})
			});

		} else {
			$.get(baseUrl + 'siswa/getSiswa', function(result) {
				let data = JSON.parse(result);
				// console.log(data)
				$('.cusName').html('');
				$('.cusName').removeAttr('disabled');
				$('.cusName').append('<option value="">Pilih Nama</option>')
				data.forEach(function(res) {
					$('.cusName').append('<option value="' + res.nis + '">' + res.namasiswa + ' ( ' + res.nis + ' )</option>')
				})
			});
			$.get(baseUrl + 'mtransaksi/getMTransaksiSiswa/siswa', function(result) {
				let data = JSON.parse(result);
				// console.log(data)
				$('.kategori').html('');
				$('.kategori').removeAttr('disabled');
				$('.kategori').append('<option value="">Pilih Transaksi</option>')
				data.forEach(function(res) {
					$('.kategori').append('<option value="' + res.id_mastertransaksi + '">' + res.kategori + '</option>')
				})
			});
		}
	}

	$('#usertipe').val($('.tipeuserAdd').val())

	$('.btn-mem').click(() => {
		let id = $('.nameMember').val()
		let tipe = $('#bpTipeuser').val()
		$('#tableBP').html('')
		if (id != '') {
			$.get(baseUrl + 'transaksi/detailTransaksi?id=' + parseInt(id) + '&tipe=' + tipe, function(result) {
				let data = JSON.parse(result)
				// console.log(data)
				if (data.length != 0) {
					let saldo = 0;
					let no = 1;
					let koperasiK = '';
					let koperasiD = '';
					let saldoView = 0;
					data.forEach(function(res) {
						let tgl = new Date(res.tgl_update);
						let tglbaru = tgl.getDate() + '-' + tgl.getMonth() + '-' + tgl.getFullYear();
						console.log(tglbaru);
						if (res.kredit == 'koperasi') {
							koperasiK = 'staf'
						} else if (res.debet == 'koperasi') {
							koperasiD = 'staf'
						}
						if (tipe == res.kredit || tipe == koperasiK) {
							saldo = parseInt(saldo) + parseInt(res.nominal)
						} else if (tipe == res.debet || tipe == koperasiD) {
							saldo = parseInt(saldo) - parseInt(res.nominal)
						}
						if (res.tipeuser == res.debet) {
							saldoView = saldoView - parseInt(res.nominal)
							$('#tableBP').append('<tr><td>' + no++ + '</td><td>' + res.tgl_update + '</td><td>' + res.keterangan + '</td><td>' + formatRupiah(res.nominal, 'Rp. ') + '</td><td> </td><td>' + formatRupiah(saldoView.toString(), "Rp. ") + '</td></tr>')
						} else {
							saldoView = saldoView + parseInt(res.nominal)
							$('#tableBP').append('<tr><td>' + no++ + '</td><td>' + res.tgl_update + '</td><td>' + res.keterangan + '</td><td></td><td>' + formatRupiah(res.nominal, 'Rp. ') + '</td><td>' + formatRupiah(saldoView.toString(), "Rp. ") + '</td></tr>')
						}
					})
					// console.log(saldo)
					$('.tfoot').html(` <tr>
                                            <th style="font-weigth: 600; text-align: right;" align="right">Sisa Saldo : </th>
                                            <th style="min-width: 134px; width: 134px; max-width: 134px;">` + formatRupiah(saldo.toString(), "Rp. ") + `</th>
                                        </tr>`)
				} else {
					$('#tableBP').html('')
					$('#tableBP').append('<tr><td colspan="6" align="center">Tidak ada Transaksi</td></tr>')
				}
			});
		} else {
			alert('Pilih Nama')
		}
	})

	$('#bpTipeuser').change(function() {
		if ($(this).val() == 'siswa') {
			$.get(baseUrl + 'siswa/getSiswa', function(result) {
				let data = JSON.parse(result);
				// console.log(data)
				$('.nameMember').html('');
				$('.nameMember').removeAttr('disabled');
				$('.btn-mem').removeAttr('disabled');
				$('.nameMember').html('<option value="">Pilih Nama</option>')
				data.forEach(function(res) {
					$('.nameMember').append('<option value="' + res.nis + '">' + res.namasiswa + ' ( ' + res.nis + ' )</option>')
				})
			});
		} else if ($(this).val() == 'staf') {
			$.get(baseUrl + 'staff/getStaff', function(result) {
				let data = JSON.parse(result);
				// console.log(data)
				$('.nameMember').html('');
				$('.nameMember').removeAttr('disabled');
				$('.btn-mem').removeAttr('disabled');
				$('.nameMember').html('<option value="">Pilih Nama</option>')
				data.forEach(function(res) {
					$('.nameMember').append('<option value="' + res.id_staf + '">' + res.nama + '</option>')
				})
			});
		} else {
			$('.nameMember').html('<option value="">Pilih Nama</option>')
			$('.nameMember').attr('disabled', 'disabled');
			$('.btn-mem').attr('disabled', 'disabled');
		}
	})

	let sssaldo = 0;

	$('.cusName').change(function() {
		$('.sisasaldo').val('')
		$('#saldoBox').html('')
		$('.inpt').attr('disabled', 'disabled')
		$('#warning').css("display", "none")
		$('.kategori').removeAttr('disabled')
		$('.cusName').removeAttr('disabled')
		$('.btnAdd').attr('disabled', true)
		$('#id_jenistransaksi').val('')
		$('#kode').val('')
		$('#kode_transaksi').val('')
		$('#keterangan').val('')
		$('.nominalInp').val('')
		if ($(this).val() != 'Pilih Nama') {
			$('.kategori').removeAttr('disabled')
			$('.cusName').removeAttr('disabled')
			$('#box-transaksi').html('')
			$('#id_customer').val($(this).val())
			let tipe = $('.tipeuserAdd').val()
			// console.log(tipe)
			if (tipe == 2) {
				$.get(baseUrl + 'transaksi/getSaldoSiswa/' + $(this).val(), function(res) {
					$('#saldoBox').html(formatRupiah(res, "Rp. "))
					$('#saldoBox').attr('data-saldo', parseInt(res))
					$('#sisasaldo').val(parseInt(res))
					let saldo = parseInt(res)
					let kredit = $('.nominalInp').attr('tipe-kredit')
					let nominal = $('.nominalInp').val();
					if (nominal == '') {
						var one = nominal.slice(4, nominal.length);
						var res = one.replace(".", "");
						if (kredit == 'siswa') {

						} else {
							if (nominal < saldo) {
								$('#warning').css("display", "none")
								// $('.btnAdd').removeAttr('disabled')
							} else if (nominal > saldo) {
								$('#warning').css("display", "block")
								// $('.btnAdd').attr('disabled', true)
							}
						}
					}
				})
			} else if (tipe == 1) {
				let id_staf = $(this).val()
				$.get(baseUrl + 'Transaksi/getTransaksiStafByid/' + id_staf, function(result) {
					// let data = JSON.parse(result);
					sssaldo = result
					$('#saldoBox').html(formatRupiah(result.toString(), "Rp. "))
					$('#saldoBox').attr('data-saldo', parseInt(result))
					$('#sisasaldo').val(parseInt(result))
					let saldo = parseInt(result)
					// let kredit = $('.nominalInp').attr('tipe-kredit')
					let nominal = $('.nominalInp').val();
					if (nominal == '') {
						var one = nominal.slice(4, nominal.length);
						var res = one.replace(/[^\w\s]/gi, '');
						// if(kredit == 'siswa'){

						// }else{
						if (parseInt(res) <= parseInt(saldo)) {
							$('#warning').css("display", "none")
							$('.btnAdd').removeAttr('disabled')
						} else if (parseInt(res) >= parseInt(saldo)) {
							$('#warning').css("display", "block")
							$('.btnAdd').attr('disabled', true)
						}
						// }
					}
				})
			}
			$.get(baseUrl + 'transaksi/getHistoriTransaksi?id=' + parseInt($(this).val()) + '&tipe=' + $('.tipeuserAdd').val(), function(result) {
				let data = JSON.parse(result)
				// console.log(tipe.strtolower)
				if (data.length != 0) {
					let no = 1;
					let tipeTransaksi = '';
					let tanggal = '';
					let tanggalBaru = '';
					let koperDebet = '';
					let koperKredit = '';
					data.forEach(function(res) {
						tanggal = res.tgl_update;
						tanggalBaru = tanggal.slice(0, 10);
						if (res.debet == 'koperasi') {
							koperDebet = 'staf'
						} else if (res.kredit == 'koperasi') {
							koperKredit = 'staf'
						}
						if (res.debet == 'siswa' || koperDebet == 'staf') {
							tipeTransaksi = 'Debet'
						} else if (res.kredit == 'siswa' || koperKredit == 'staf') {
							tipeTransaksi = 'Kredit'
						}
						$('#box-transaksi').append(`<tr>
                                                        <td><b>` + no++ + `. </b></td> 
                                                        <td>` + tanggalBaru + `</td>
                                                        <td><b>` + res.keterangan + `</b></td>
                                                        <td>` + formatRupiah(res.nominal, 'Rp. ') + `</td>
                                                        <td align="center"><center>` + tipeTransaksi + `</center></td>
                                                    </tr>`)
					})
				} else {
					$('#box-transaksi').append(`<tr>
                                                    <td colspan="4">Tidak Ada Transaksi</td>
                                                </tr>`)
				}
			});
			if ($('.tipeuserAdd').val() != 'salah') {
				if (parseInt($('.tipeuserAdd').val()) == 1) {
					$.get(baseUrl + 'mtransaksi/getMTransaksiStaf/koperasi', function(result) {
						let data = JSON.parse(result);
						if (data.length != 0) {
							$('.kategori').html('');
							$('.kategori').removeAttr('disabled');
							$('.kategori').append('<option value="salah">Pilih Transaksi</option>')
							data.forEach(function(res) {
								$('.kategori').append('<option value="' + res.id_mastertransaksi + '">' + res.kategori + '</option>')
							})
						} else {
							$('.kategori').html('');
							$('.kategori').append('<option value="salah">Transaksi Kosong</option>')
						}
					});

				} else {
					$.get(baseUrl + 'mtransaksi/getMTransaksiSiswa/siswa', function(result) {
						let data = JSON.parse(result);
						if (data.length != 0) {
							$('.kategori').html('');
							$('.kategori').removeAttr('disabled');
							$('.kategori').append('<option value="salah">Pilih Transaksi</option>')
							data.forEach(function(res) {
								$('.kategori').append('<option value="' + res.id_mastertransaksi + '">' + res.kategori + '</option>')
							})
						} else {
							$('.kategori').html('');
							$('.kategori').append('<option value="salah">Transaksi Kosong</option>')
						}
						// console.log(data)

					});
				}
			}
		}
	})

	$('.btnAdd').click(function() {
		setInterval(() => {
			$('#box-transaksi').html('')
			$('.nameMember').html('')
			$('.inpt').attr('disabled', 'disabled')
			$('.kategori').attr('disabled', 'disabled')
			$('.kategori').html('')
			$('.cusName').attr('disabled', 'disabled')
			$('.cusName').html('')
			$('#id_jenistransaksi').val('')
			$('#kode').val('')
			$('#kode_transaksi').val('')
			$('#keterangan').val('')
			$('.nominalInp').val('')
		}, 500);
	})

	$('#jurnalTs').change(function() {
		if ($(this).val() != 'pilih') {
			reRadio()
			if ($(this).val() == 'transaksi') {
				$('.transaksiField').html('')
				$('.transaksiField').append('<option value="salah">Pilih Transaksi</option>')
				// console.log($(this).val())
				$.get(baseUrl + 'transaksi/getTransaksi', function(result) {
					let data = JSON.parse(result)
					// console.log(data)
					if (data.length != 0) {
						let no = 1;
						$('.transaksiField').removeAttr('disabled');
						data.forEach(function(res) {
							var d = res.tgl_update;
							d = d.split(' ')[0]
							$('.transaksiField').append('<option tipe="transaksi" keterangan="' + res.keterangan + '" type="' + res.type + '" kredit="' + res.kredit + '" debet="' + res.debet + '" nominal="' + res.nominal + '" value="' + res.id_transaksi + '">' + d + ' ' + res.namaTransaksi + '(' + res.noIden + ') <b>' + res.keterangan + '</b></option>')
						})
					} else {
						$('.transaksiField').html('')
						$('.transaksiField').attr('disabled', 'disabled')
						$('.transaksiField').append('<option>Transaksi Kosong</option>')
					}
				});
			} else if ($(this).val() == 'kaskeluar') {
				$('.transaksiField').html('')
				$('.transaksiField').append('<option value="salah">Pilih Kas Keluar</option>')
				$.get(baseUrl + 'kaskeluar/getKasKeluar', function(result) {
					let data = JSON.parse(result)
					// console.log(data)
					if (data.length != 0) {
						$('.transaksiField').removeAttr('disabled');
						data.forEach(function(res) {
							var d = res.tgltransaksi;
							d = d.split(' ')[0]
							$('.transaksiField').append('<option tipe="kk" keterangan="' + res.keterangan + '" nominal="' + res.nominal + '" value="' + res.id_kk + '">' + d + ' ' + res.keterangan + ' (' + res.kode_kas_keluar + ') <b>' + formatRupiah(res.nominal, "Rp. ") + '</b></option>')
						})
					} else {
						$('.transaksiField').html('')
						$('.transaksiField').attr('disabled', 'disabled')
						$('.transaksiField').append('<option>Kas Keluar Kosong</option>')
					}
				});
			} else if ($(this).val() == 'kasmasuk') {
				$('.transaksiField').html('')
				$('.transaksiField').append('<option value="salah">Pilih Kas Masuk</option>')
				$.get(baseUrl + 'kasmasuk/getKasMasuk', function(result) {
					let data = JSON.parse(result)
					// console.log(data)
					if (data.length != 0) {
						let no = 1;
						$('.transaksiField').removeAttr('disabled');
						data.forEach(function(res) {
							var d = res.tgltransaksi;
							d = d.split(' ')[0]
							$('.transaksiField').append('<option tipe="km" keterangan="' + res.keterangan + '" nominal="' + res.nominal + '" value="' + res.id_km + '">' + d + ' ' + res.keterangan + ' (' + res.kode_kas_masuk + ') <b>' + formatRupiah(res.nominal, "Rp. ") + '</b></option>')
						})
					} else {
						$('.transaksiField').html('')
						$('.transaksiField').attr('disabled', 'disabled')
						$('.transaksiField').append('<option>Kas Masuk Kosong</option>')
					}
				});
			}
		} else {
			$('.transaksiField').html('')
			$('.transaksiField').attr('disabled', 'disabled')
			$('.transaksiField').append(' <option value="">Pilih Transaksi</option>')
		}
	})

	$('.transaksiField').change(function() {
		reRadio()
		let nominal = $('.transaksiField option:selected').attr('nominal')
		let tipe = $('.transaksiField option:selected').attr('tipe')
		if (tipe == 'kk') {
			$('.radioTwo .iradio_square-blue').attr('class', 'iradio_square-blue checked')
			$('#two').attr('checked', false)
		} else if (tipe == 'km') {
			$('#two').attr('checked', false)
			$('.radioOne .iradio_square-blue').attr('class', 'iradio_square-blue checked')
		} else if (tipe == 'transaksi') {
			let type = $('.transaksiField option:selected').attr('type');
			let debet = $('.transaksiField option:selected').attr('debet');
			let kredit = $('.transaksiField option:selected').attr('kredit');
			let koperDebet = '';
			let koperKredit = '';
			if (debet == 'koperasi') {
				koperDebet = 'staf'
			} else if (kredit == 'koperasi') {
				koperKredit = 'staf'
			}
			if (type == debet || type == koperDebet) {
				$('.radioOne .iradio_square-blue').attr('class', 'iradio_square-blue checked')
				$('#two').attr('checked', false)
			} else if (type == kredit || type == koperKredit) {
				$('#two').attr('checked', false)
				$('.radioTwo .iradio_square-blue').attr('class', 'iradio_square-blue checked')
			}
		}
		$('.nominalJurnal').val(formatRupiah(nominal, 'Rp. '))
		$('.btnGenerate').removeAttr('disabled')
	})

	$('.btnGenerate').click(function() {
		$('#confirmTable').show()
		$('.jurnalKeterangan').html('')
		$('.jurnalDebet').html('')
		$('.jurnalKredit').html('')
		$('input[name="jurnal_id_transaksi"]').val('')
		$('input[name="jurnal_tipe_transaksi"]').val('')
		$('input[name="transaksi_kredit"]').val('')
		$('input[name="transaksi_debet"]').val('')
		$('input[name="nominal_kredit"]').val('')
		$('input[name="nominal_debet"]').val('')
		$('input[name="kode_coa_debet"]').val('')
		$('input[name="kode_coa_kredit"]').val('')

		let nominal = $('.transaksiField option:selected').attr('nominal')
		let keterangan = $('.transaksiField option:selected').attr('keterangan')
		let tipe = $('.transaksiField option:selected').attr('tipe');
		let debet = $('.transaksiField option:selected').attr('debet')
		let kredit = $('.transaksiField option:selected').attr('kredit')
		let koperDebet = ''
		let koperKredit = ''
		$('.jurnalKeterangan').html(keterangan)
		$('.jurnalKredit').html(formatRupiah(nominal, 'Rp. '))
		$('input[name="nominal_kredit"]').val(nominal)
		$('.jurnalDebet').html(formatRupiah(nominal, 'Rp. '))
		$('input[name="nominal_debet"]').val(nominal)
		if (tipe == 'kk') {
			$('input[name="transaksi_kredit"]').val($('.transaksiField').val())
		} else if (tipe == 'km') {
			$('input[name="transaksi_debet"]').val($('.transaksiField').val())
		} else if (tipe == 'transaksi') {
			let type = $('.transaksiField option:selected').attr('type');
			if (debet == 'koperasi') {
				koperDebet = 'staf'
			}
			if (kredit == 'koperasi') {
				koperKredit = 'staf'
			}
			if (type == debet || type == koperDebet) {
				$('input[name="transaksi_debet"]').val($('.transaksiField').val())
			} else if (type == kredit || type == koperKredit) {
				$('input[name="transaksi_kredit"]').val($('.transaksiField').val())
			}

		}
	})

	function reRadio() {
		$('.radioOne .iradio_square-blue').attr('class', 'iradio_square-blue')
		$('.radioTwo .iradio_square-blue').attr('class', 'iradio_square-blue')
		$('.nominalJurnal').val('')
		$('#two').attr('checked', false)
		$('#one').attr('checked', false)
	}

	$('.btnGenerate').click(function() {
		$('#confirmTable').show()
		$('.jurnalKeterangan').html('')
		$('.jurnalDebet').html('')
		$('.jurnalKredit').html('')
		$('input[name="jurnal_id_transaksi"]').val('')
		$('input[name="jurnal_tipe_transaksi"]').val('')
		$('input[name="transaksi_kredit"]').val('')
		$('input[name="transaksi_debet"]').val('')
		$('input[name="nominal_kredit"]').val('')
		$('input[name="nominal_debet"]').val('')

		let nominal = $('.transaksiField option:selected').attr('nominal')
		let keterangan = $('.transaksiField option:selected').attr('keterangan')
		let tipe = $('.transaksiField option:selected').attr('tipe');
		let debet = $('.transaksiField option:selected').attr('debet')
		let kredit = $('.transaksiField option:selected').attr('kredit')
		let koperDebet = ''
		let koperKredit = ''
		$('input[name="jurnal_id_transaksi"]').val($('.transaksiField').val())
		$('input[name="jurnal_tipe_transaksi"]').val(tipe)
		$('.jurnalKeterangan').html(keterangan)
		$('.jurnalKredit').html(formatRupiah(nominal, 'Rp. '))
		$('.jurnalDebet').html(formatRupiah(nominal, 'Rp. '))
		$('input[name="nominal_kredit"]').val(nominal)
		$('input[name="nominal_debet"]').val(nominal)
		if (tipe == 'kk') {
			$('input[name="transaksi_kredit"]').val($('.transaksiField').val())
		} else if (tipe == 'km') {
			$('input[name="transaksi_debet"]').val($('.transaksiField').val())
		} else if (tipe == 'transaksi') {
			let type = $('.transaksiField option:selected').attr('type');
			if (debet == 'koperasi') {
				koperDebet = 'staf'
			} else if (kredit == 'koperasi') {
				koperKredit = 'staf'
			}
			if (type == debet || type == koperDebet) {
				$('input[name="transaksi_debet"]').val($('.transaksiField').val())
			} else if (type == kredit || type == koperKredit) {
				$('input[name="transaksi_kredit"]').val($('.transaksiField').val())
			}
		}
	})

	$('#kodeCOA1').change(function() {
		if ($(this).val() != 'salah') {
			$('input[name="kode_coa_debet"]').val($(this).val())
			$.get(baseUrl + 'mastercoa/getKode/' + $(this).val(), function(result) {
				let data = JSON.parse(result)
				if (data.length != 0) {
					let no = 1;
					$('#kodeCOA2').html('')
					$('#kodeCOA2').removeAttr('disabled')
					$('#kodeCOA2').append('<option value="salah">Pilih Kode COA Kredit</option>')
					data.forEach(function(res) {
						$('#kodeCOA2').append('<option value="' + res.kode_coa + '">' + res.kode_coa + ' - ' + res.akun + '</option>')
					})
				}
			});
		}
	})

	$('#kodeCOA2').change(function() {
		if ($(this).val() != 'salah') {
			$('input[name="kode_coa_kredit"]').val($(this).val())
			$('.btn-saveJurnal').removeAttr('disabled')
		}
	})

	$('#downTMP').click(function() {
		window.location.href = baseUrl + "siswa/downloadTMP/" + $('#kelasDownload').val();
		// console.log($('#kelasDownload').val())
	})

	$('#kelasDownload').change(function() {
		if ($(this).val() != 'salah') {
			$('#downTMP').removeAttr('disabled')
		} else {
			$('#downTMP').attr('disabled', true)
		}
	})

	$('#viewGrad').hide()

	$('#kelasGrad').change(function() {
		if ($(this).val() != 'salah') {
			$('#rowGrad').html('')
			$('#siswaGrad').attr('disabled', true);
			$('#viewGrad').show()
			// console.log($(this).val())
			$.get(baseUrl + 'siswa/getSiswaByKelas/' + $(this).val(), function(res) {
				console.log(res)
				let data = JSON.parse(res)
				if (data.length == 0) {
					$('#lulusKanSemua').html(``)
					$('#rowGrad').append(`
                                    <tr>
                                        <td colspan="6" align="center">Tidak ada Siswa di kelas ini</td>                                           
                                    </tr>
                                `)
				} else {
					let no = 1
					$('#lulusKanSemua').html(`<button class="btn btn-success" onclick="lulusAll(` + $('#kelasGrad').val() + `);">
                                                        <i class="fa fa-check"></i>
                                                        Luluskan Semua
                                                    </button>`)
					data.forEach(function(resu) {
						$('#rowGrad').append(`
                                        <tr>
                                            <td>` + no++ + `</td>
                                            <td>` + resu.nis + `</td>
                                            <td id="` + resu.nis + `">` + resu.namasiswa + `</td>
                                            <td>` + resu.kelas + `</td>
                                            <td>` + resu.jk + `</td>
                                            <td>` + resu.tglawal + ` - ` + resu.tglakhir + `</td>
                                            <td>
                                                <button class="btn btn-success btnGradS" onclick="lulus(` + resu.nis + `);" data-nama="` + resu.namasiswa + `" data-id="">
                                                    <i class="fa fa-check"></i>
                                                    Tandai Lulus
                                                </button>
                                            </td>
                                        </tr>
                                    `)
					})
				}
			})
		} else {
			$('#siswaGrad').removeAttr('disabled');
			$('#viewGrad').hide()
			$('#lulusKanSemua').html(``)
		}
	})

	$('#siswaGrad').keyup(function() {
		// console.log($(this).val())
		$('#rowGrad').html('')
		if ($(this).val() != '') {
			$('#rowGrad').html('')
			$('#kelasGrad').attr('disabled', true);
			$('#viewGrad').show()
			$.get(baseUrl + 'siswa/getSiswaSrch/' + $(this).val(), function(res) {
				let data = JSON.parse(res)
				if (data.length === 0) {
					$('#rowGrad').html('')
					$('#rowGrad').append(`
                                    <tr>
                                        <td colspan="6">Tidak ada Siswa</td>                                           
                                    </tr>
                                `)
				} else {
					$('#rowGrad').html('')
					let no = 1
					data.forEach(function(resu) {
						$('#rowGrad').append(`
                                        <tr>
                                            <td>` + no++ + `</td>
                                            <td>` + resu.nis + `</td>
                                            <td id="` + resu.nis + `">` + resu.namasiswa + `</td>
                                            <td>` + resu.jk + `</td>
                                            <td>` + resu.kelas + `</td>
                                            <td>` + resu.tglawal + ` - ` + resu.tglakhir + `</td>
                                            <td><button class="btn btn-success" onclick="lulus(` + resu.nis + `);"><i class="fa fa-check"></i>Tandai Lulus</button></td>
                                        </tr>
                                    `)
					})
				}
			})
		} else {
			$('#rowGrad').html('')
			$('#kelasGrad').removeAttr('disabled');
			$('#viewGrad').hide()
		}
	})

	toastr.options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": false,
		"progressBar": false,
		"positionClass": "toast-top-right",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "3500",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}

	function lulus(nis) {
		// console.log($("#"+nis).html())
		if (confirm('Yakin Untuk meluluskan ' + $("#" + nis).html() + ' !!!')) {
			// console.log('ya')
			$.get(baseUrl + 'siswa/gradByOne/' + nis, function(res) {
				if (res == 'berhasil') {
					if ($('#kelasGrad').val() != 'salah' && $('#siswaGrad').val() == '') {
						$('#rowGrad').html('')
						$('#siswaGrad').attr('disabled', true);
						$('#viewGrad').show()
						toastr["success"]("Berhasil Meluluskan Siswa!");
						$.get(baseUrl + 'siswa/getSiswaByKelas/' + $('#kelasGrad').val(), function(res) {
							// console.log(res)
							let data = JSON.parse(res)
							if (data.length == 0) {
								$('#rowGrad').append(`
                                                <tr>
                                                    <td colspan="6" align="center">Tidak ada Siswa di kelas ini</td>                                           
                                                </tr>
                                            `)
							} else {
								let no = 1
								data.forEach(function(resu) {
									$('#rowGrad').append(`
                                                    <tr>
                                                        <td>` + no++ + `</td>
                                                        <td>` + resu.nis + `</td>
                                                        <td id="` + resu.nis + `">` + resu.namasiswa + `</td>
                                                        <td>` + resu.alamat + `</td>
                                                        <td>` + $('#kelasGrad').val() + `</td>
                                                        <td>` + resu.jk + `</td>
                                                        <td>
                                                            <button class="btn btn-success btnGradS" onclick="lulus(` + resu.nis + `);" data-nama="` + resu.namasiswa + `" data-id="">
                                                                <i class="fa fa-check"></i>
                                                                Tandai Lulus
                                                            </button>
                                                        </td>
                                                    </tr>
                                                `)
								})
							}
						})
					} else if ($('#kelasGrad').val() == 'salah' && $('#siswaGrad').val() != '') {
						$('#rowGrad').html('')
						$('#kelasGrad').attr('disabled', false);
						$('#viewGrad').hide()
						$('#siswaGrad').val('')
						toastr["success"]("Berhasil Meluluskan Siswa!");
					}
				} else {
					toastr["warning"]("Gagal Coba Lagi !");
				}
			})
		} else {
			console.log('tidak')
		}
	}

	function lulusAll(idKelas) {
		// console.log(idKelas)
		let kelas = $('#kelasGrad option:selected').html();
		if (confirm('Yakin Untuk meluluskan siswa' + kelas + '!!!')) {
			// console.log('ya')
			$.get(baseUrl + 'siswa/grad_process/' + idKelas, function(res) {
				if (res == 'berhasil') {
					if ($('#kelasGrad').val() != 'salah' && $('#siswaGrad').val() == '') {
						$('#rowGrad').html('')
						$('#siswaGrad').attr('disabled', true);
						$('#viewGrad').show()
						toastr["success"]("Berhasil Meluluskan Siswa Kelas " + kelas);
						$.get(baseUrl + 'siswa/getSiswaByKelas/' + $('#kelasGrad').val(), function(res) {
							// console.log(res)
							let data = JSON.parse(res)
							if (data.length == 0) {
								$('#rowGrad').append(`
                                                <tr>
                                                    <td colspan="6" align="center">Tidak ada Siswa di kelas ini</td>                                           
                                                </tr>
                                            `)
							} else {
								let no = 1
								data.forEach(function(resu) {
									$('#rowGrad').append(`
                                                    <tr>
                                                        <td>` + no++ + `</td>
                                                        <td>` + resu.nis + `</td>
                                                        <td id="` + resu.nis + `">` + resu.namasiswa + `</td>
                                                        <td>` + resu.alamat + `</td>
                                                        <td>` + resu.kelas + `</td>
                                                        <td>` + resu.jk + `</td>
                                                        <td>
                                                            <button class="btn btn-success btnGradS" onclick="lulus(` + resu.nis + `);" data-nama="` + resu.namasiswa + `" data-id="">
                                                                <i class="fa fa-check"></i>
                                                                Tandai Lulus
                                                            </button>
                                                        </td>
                                                    </tr>
                                                `)
								})
							}
						})
					}
				} else {
					toastr["warning"]("Gagal Coba Lagi !");
				}
			})
		} else {
			console.log('tidak')
		}
	}

	if (transaksiEdit) {
		let idcus = $("#id_customer").val()
		if (parseInt($('.tipeuserAdd').val()) == 1) {
			$.get(baseUrl + 'staff/getStaff', function(result) {
				let data = JSON.parse(result);
				// console.log(data)
				$('.cusName').html('');
				$('.cusName').removeAttr('disabled');
				$('.cusName').append('<option value="">Pilih Nama</option>')
				data.forEach(function(res) {
					if (res.id_staf == idcus) {
						$('.cusName').append('<option value="' + res.id_staf + '" selected>' + res.nama + '</option>')
					} else {
						$('.cusName').append('<option value="' + res.id_staf + '">' + res.nama + '</option>')
					}
				})
			});
		} else {
			$.get(baseUrl + 'siswa/getSiswa', function(result) {
				let data = JSON.parse(result);
				// console.log(data)
				$('.cusName').html('');
				$('.cusName').removeAttr('disabled');
				$('.cusName').append('<option value="">Pilih Nama</option>')
				data.forEach(function(res) {
					if (res.nis == idcus) {
						$('.cusName').append('<option value="' + res.nis + '" selected>' + res.namasiswa + ' ( ' + res.nis + ' )</option>')
					} else {
						$('.cusName').append('<option value="' + res.nis + '">' + res.namasiswa + ' ( ' + res.nis + ' )</option>')
					}
				})
			});
		}

		let idjt = $("#id_jenistransaksi").val()
		if ($(".cusName").val() != '') {
			$.get(baseUrl + 'mtransaksi/detailTransaksi/' + idjt, function(result) {
				let data = JSON.parse(result);
				$.get(baseUrl + 'transaksi/getNewKode/' + data.kodetransaksi, function(res) {
					$('#kode').val(res)
					$('#kode_transaksi').val(res)
				})
				$('#id_jenistransaksi').val(data.id_mastertransaksi)
				$('#keterangan').val(data.deskripsi)
				$('.nominalInp').val(formatRupiah(data.nominal, "Rp. "))
				$('.nominalInp').attr('nominal', data.nominal)
				let saldo = $('#saldoBox').attr('data-saldo')
				if (data.kredit == 'siswa') {
					$('.nominalInp').attr('tipe-kredit', data.kredit)
					$('.btnAdd').removeAttr('disabled')
					$('#warning').css("display", "none")
					$('#tipeTransaksi').val('kredit')
				} else if (data.debet == 'siswa') {
					$('#tipeTransaksi').val('debet')
					$('.nominalInp').attr('tipe-debet', data.debet)
					if (data.nominal > parseInt(saldo)) {
						$('#warning').css("display", "block")
						$('.btnAdd').attr('disabled', 'disabled')
					} else {
						$('#warning').css("display", "none")
						$('.btnAdd').removeAttr('disabled')
					}
				}
				// if(data.kredit == 'koperasi'){
				//     $('.nominalInp').attr('tipe-kredit', data.kredit)
				//     $('.btnAdd').removeAttr('disabled')
				//     $('#warning').hide()
				//     $('#tipeTransaksi').val('kredit')
				if (data.debet == 'koperasi') {
					$('#tipeTransaksi').val('debet')
					$('.nominalInp').attr('tipe-debet', data.debet)
					if (data.nominal > parseInt(saldo)) {
						$('#warning').css("display", "block")
						$('.btnAdd').attr('disabled', 'disabled')
					} else {
						$('#warning').css("display", "none")
						$('.btnAdd').removeAttr('disabled')
					}
				}
			});
			if (parseInt($('.tipeuserAdd').val()) == 1) {
				$.get(baseUrl + 'mtransaksi/getMTransaksiStaf/koperasi', function(result) {
					let data = JSON.parse(result);
					// console.log(data)
					$('.kategori').html('');
					$('.kategori').removeAttr('disabled');
					$('.kategori').append('<option value="salah">Pilih Transaksi</option>')
					data.forEach(function(res) {
						if (res.id_mastertransaksi == idjt) {
							$('.kategori').append('<option value="' + res.id_mastertransaksi + '" selected>' + res.kategori + '</option>')
						} else {
							$('.kategori').append('<option value="' + res.id_mastertransaksi + '">' + res.kategori + '</option>')
						}
					})
				});
			} else {
				$.get(baseUrl + 'mtransaksi/getMTransaksiSiswa/siswa', function(result) {
					let data = JSON.parse(result);
					// console.log(data)
					$('.kategori').html('');
					$('.kategori').removeAttr('disabled');
					$('.kategori').append('<option value="salah">Pilih Transaksi</option>')
					data.forEach(function(res) {
						if (res.id_mastertransaksi == idjt) {
							$('.kategori').append('<option value="' + res.id_mastertransaksi + '" selected>' + res.kategori + '</option>')
						} else {
							$('.kategori').append('<option value="' + res.id_mastertransaksi + '">' + res.kategori + '</option>')
						}
					})
				});
			}
		}

		let nom = $("#nominal").val();
		$("#inputNominal").val(formatRupiah(nom, "Rp. "));

		if ($('.tipeuserAdd').val() == '2') {
			$.get(baseUrl + 'transaksi/getSaldoSiswa/' + idcus, function(res) {
				$('#saldoBox').html(formatRupiah(res, "Rp. "))
				$('#saldoBox').attr('data-saldo', parseInt(res))
				console.log($(".cusName").val())
				$('#sisasaldo').val(parseInt(res))
				let saldo = parseInt(res)
				let kredit = $('.nominalInp').attr('tipe-kredit')
				let nominal = $('.nominalInp').val();
				if (nominal == '') {
					var one = nominal.slice(4, nominal.length);
					var res = one.replace(".", "");
					if (kredit == 'siswa') {

					} else {
						if (nominal < saldo) {
							$('#warning').css("display", "none")
							// $('.btnAdd').removeAttr('disabled')
						} else if (nominal > saldo) {
							$('#warning').css("display", "block")
							// $('.btnAdd').attr('disabled', true)
						}
					}
				}
			})
		} else if ($('.tipeuserAdd').val() == '1') {
			let id_staf = idcus
			$.get(baseUrl + 'Transaksi/getTransaksiStafByid/' + id_staf, function(result) {
				let data = JSON.parse(result);
				sssaldo = data.saldo
				$('#saldoBox').html(formatRupiah(data.saldo.toString(), "Rp. "))
				$('#saldoBox').attr('data-saldo', parseInt(data.saldo))
				$('#sisasaldo').val(parseInt(data.saldo))
				let saldo = parseInt(data.saldo)
				// let kredit = $('.nominalInp').attr('tipe-kredit')
				let nominal = $('.nominalInp').val();
				if (nominal == '') {
					var one = nominal.slice(4, nominal.length);
					var res = one.replace(/[^\w\s]/gi, '');
					// if(kredit == 'siswa'){

					// }else{
					if (parseInt(res) <= parseInt(saldo)) {
						$('#warning').css("display", "none")
						// $('.btnAdd').removeAttr('disabled')
					} else if (parseInt(res) >= parseInt(saldo)) {
						$('#warning').css("display", "block")
						// $('.btnAdd').attr('disabled', true)
					}
					// }
				}
			})
		}
		let tipe = $('.tipeuserAdd option:selected').html()
		$('#box-transaksi').html('')
		$.get(baseUrl + 'transaksi/getHistoriTransaksi?id=' + idcus + '&tipe=' + $('.tipeuserAdd').val(), function(result) {
			let data = JSON.parse(result)
			// console.log(result)
			// console.log(tipe.strtolower)
			if (data.length != 0) {
				let no = 1;
				let tipeTransaksi = '';
				let tanggal = '';
				let tanggalBaru = '';
				let koperDebet = '';
				let koperKredit = '';
				data.forEach(function(res) {
					tanggal = res.tgl_update;
					tanggalBaru = tanggal.slice(0, 9);
					if (res.debet == 'koperasi') {
						koperDebet = 'staf'
					} else if (res.kredit == 'koeperasi') {
						koperKredit = 'staf'
					}
					if (res.debet == tipe.toLowerCase() || koperDebet == tipe.toLowerCase()) {
						tipeTransaksi = 'Debet'
					} else if (res.kredit == tipe.toLowerCase() || koperKredit == tipe.toLowerCase()) {
						tipeTransaksi = 'Kredit'
					}
					$('#box-transaksi').append(`<tr>
                                                        <td><b>` + no++ + `. </b></td> 
                                                        <td style="min-width: 125px;">` + tanggalBaru + `</td>
                                                        <td style="min-width: 377px;width: 377px;"><b>` + res.keterangan + `</b></td>
                                                        <td style="min-width: 125px;">` + formatRupiah(res.nominal, 'Rp. ') + `</td>
                                                        <td style="min-width: 125px;" align="center"><center>` + tipeTransaksi + `</center></td>
                                                    </tr>`)
				})
			} else {
				$('#box-transaksi').append(`<tr>
                                                    <td colspan="4">Tidak Ada Transaksi</td>
                                                </tr>`)
			}
		});

	}
	$('#provinsi').change(function() {
		if (this.value !== 'Pilih Provinsi') {
			$.get(baseUrl + 'siswa/getkota/' + this.value, function(result) {
				let data = JSON.parse(result);
				$('#selectKota').html('');
				$('#selectKeca').html('');
				$('#selectKota').removeAttr('disabled');
				$('#selectKota').append('<option value="">Pilih Kota</option>')
				$('#selectKeca').append('<option value="">Pilih Kecamatan</option>')
				data.forEach(function(res) {
					$('#selectKota').append('<option class="optkota" value="' + res.id_kota + '">' + res.name_kota + '</option>')
				})
			});
		}
	})

	$('#selectKota').change(function() {
		if (this.value !== 'Pilih Kota') {
			$.get(baseUrl + 'siswa/getKecamatan/' + this.value, function(result) {
				let data = JSON.parse(result);
				$('#selectKeca').html('');
				$('#selectKeca').removeAttr('disabled');
				$('#selectKeca').append('<option value="">Pilih Kecamatan</option>')
				data.forEach(function(res) {
					$('#selectKeca').append('<option value="' + res.id_kecamatan + '">' + res.kecamatan + '</option>')
				})
			});
		}
	})

	$('#siswaKelas').change(function() {
		let idKelas = this.value;
		console.log(idKelas)
		if (this.value !== 'Pilih Kelas') {
			$.get(baseUrl + 'siswa/getSiswaByKelas/' + this.value, function(result) {
				let data = JSON.parse(result);
				$('#dataSiswaKelas').html(' ');
				// $('#selectKeca').removeAttr('disabled');
				if (data.length === 0 || data === null || data === undefined) {
					$('#dataSiswaKelas').append('<tr><td colspan="7" align="center">Tidak Ada Data</td></tr>');
					$('.btn-grad').attr('disabled', 'disabled');
				} else {
					let i = 1;
					$('.btn-grad').removeAttr('disabled');
					$('.btn-grad').click(function() {
						if (confirm('Yakin')) {
							window.location.href = baseUrl + 'siswa/export_process/' + idKelas;
						}
					})
					let kelas = $('#siswaKelas option:selected').html()
					data.forEach(function(res) {
						$('#dataSiswaKelas').append('<tr><td>' + i + '</td><td>' + res.nis + '</td><td>' + res.namasiswa + '</td><td>' + res.alamat + '</td><td>' + res.jk + '</td><td>' + res.rfid + '</td></tr>');
						i++;
					})
				}
			});
		}
	})

	$('#btnUnCheck').hide()

	$('#btnCheckAll').click(function() {
		$('.nisCheck').attr('checked', 'checked')
		$('#btnCheckAll').hide()
		$('#btnUnCheck').show()
	})

	$('#btnUnCheck').click(function() {
		$('.nisCheck').removeAttr('checked')
		$('#btnUnCheck').hide()
		$('#btnCheckAll').show()
	})

	if (mtransaksiEdit) {
		let nominal = $("#inputNominal").val()
		$("#inputNominal").val(formatRupiah(nominal, "Rp. "))
		$('#nominal').val(nominal);
	}

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
		return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
	}

	$("#inputNominal").keyup(function() {
		var number_string = this.value.replace(/[^,\d]/g, "").toString(),
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
		this.value = "Rp. " + rupiah;
		$('#nominal').val(rupiah);
	})

	$("#ta").change(function() {
		if (this.value != 'salah') {
			$("#btnImportS").attr('disabled', false);
		} else {
			$("#btnImportS").attr('disabled', true);
		}
	})

	$("#btnImportS").click(function() {
		if (confirm('Yakin Import Data')) {
			window.location.href = baseUrl + 'siswa/import?id_tahunakademik=' + $("#ta").val();
		}
	})

	$("#fromClass").change(function() {
		$("#toClass").attr('disabled', true)
		$("#upClassTA").attr('disabled', true)
		$("#naikkelas").attr("disabled", true)
		$("#toClass").html(' ')
		$("#upClassTA").html(' ')
		if (this.value != 'salah') {
			let kelas = $("#fromClass option:selected").html().split(' ')
			// console.log(kelas)
			$.get(baseUrl + 'siswa/getSiswaByKelas/' + $(this).val(), function(res) {
				// console.log(res)
				let data = JSON.parse(res)
				if (data.length == 0) {
					$('#upClass').html('')
					$('#upClass').append(`
                                    <tr>
                                        <td colspan="7" align="center">Tidak ada Siswa di kelas ini</td>                                           
                                    </tr>
                                `)
					// $("#toClass").html('<option>Tidak ada Kelas Lain</option>')
				} else {
					let no = 1
					let idTA = 0
					$.get(baseUrl + 'kelas/getKelasList?kelas=' + kelas[0] + '&jurusan=' + kelas[1] + '&nourut=' + kelas[2], function(asd) {
						// console.log(asd)
						let data = JSON.parse(asd)
						if (data.length != 0) {
							$("#toClass").html('')
							$("#toClass").attr('disabled', false)
							$("#toClass").html('<option value="salah">Pilih Kelas</option>')
							data.forEach(function(row) {
								$("#toClass").append(`
                                    <option value="` + row.id_kelas + `">` + row.kelas + `</option>
                                `)
							})
						} else {
							$("#toClass").html('<option>Tidak ada Kelas Lain</option>')
						}
					})
					$('#upClass').html('')
					data.forEach(function(resu) {
						idTA = resu.id_tahunakademik
						$('#upClass').append(`
                            <tr>
                                <td>` + no++ + `</td>
                                <td>` + resu.nis + `</td>
                                <td id="` + resu.nis + `">` + resu.namasiswa + `</td>
                                <td>` + resu.jk + `</td>
                                <td>` + $('#fromClass option:selected').html() + `</td>
                                <td>` + new Date(resu.tglawal).getFullYear() + ` - ` + new Date(resu.tglakhir).getFullYear() + `</td>
                            </tr>
                        `)
					})
					// console.log(idTA)
					$.get(baseUrl + 'tahunakademik/getTAList/' + idTA, function(hasil) {
						// console.log(hasil)
						let tahuna = JSON.parse(hasil)
						// console.log(tahuna)
						if (tahuna.length != 0) {
							$("#upClassTA").html('')
							$("#upClassTA").html('<option value="salah">Pilih Tahun Akademik</option>')
							tahuna.forEach(function(row) {
								$("#upClassTA").append(`
                                    <option value="` + row.id_tahunakademik + `">` + new Date(row.tglawal).getFullYear() + ` - ` + new Date(row.tglakhir).getFullYear() + `</option>
                                `)
							})
						} else {
							$("#upClassTA").html('<option>Tidak ada Kelas Lain</option>')
						}
					})
				}
			})
		}
	})

	$("#toClass").change(function() {
		$("#upClassTA").attr('disabled', true)
		$("#naikkelas").attr("disabled", true)
		if (this.value != 'salah') {
			$("#upClassTA").attr('disabled', false)
		}
	})

	$("#upClassTA").change(function() {
		$("#naikkelas").attr("disabled", true)
		if (this.value != 'salah') {
			$("#naikkelas").attr("disabled", false)
		}
	})

	$("#naikkelas").click(function() {
		if (confirm("Yakin Menaikan Kelas " + $("#fromClass option:selected").html() + " ke Kelas " + $("#toClass option:selected").html())) {
			let oldkelas = $("#fromClass").val();
			let newkelas = $("#toClass").val();
			let ta = $("#upClassTA").val();
			window.location.href = baseUrl + 'siswa/naikKelas?oldKelas=' + oldkelas + '&tahun_akademik=' + ta + '&newKelas=' + newkelas
		}
		// $("#modalperingatan").show();
	})

	//kas umum

	//hri ini
	$('#lporanhri').click(function() {
		$.ajax({
			url: baseUrl + 'kasumum/hariini ',
			type: 'GET',
			beforeSend: function() {
				$("#dataKas").html('')
				$("#dataKas").append(`<tr>
                        <td colspan="6"><center>Loading</center></td>
                    </tr>`)
			},
			success: function(result) {
				$("#dataKas").html('')
				let data = JSON.parse(result);
				// console.log(data['data2'])
				if (data['data1'].length == 0) {
					$("#dataKas").append(`<tr>
                        <td colspan="6"><center>Data Kosong</center></td>
                    </tr>`)
					$("#tt").html('<p id="tt" style="font-weight: bold; font-size: 30px; margin-top: 30px">TOTAL : ' + formatRupiah("0", 'Rp. ') + '</p>')
				} else {
					// console.log(data)
					// $("#dataKas").append(`<tr>
					//     <td></td>
					//     <td>Saldo Awal</td>
					//     <td>` + data['data2'][0] + `</td>
					//     <td>` + 0 + `</td>
					//     <td>` + data['data2'][0] + `</td>
					// </tr>`)
					let no = 0;
					data['data1'].forEach(function(datahariini) {
						no++
						let dateee = new Date(datahariini[0])
						let mmm = (dateee.getMonth() + 1)
						let ddd = dateee.getDate()
						if (mmm == 1) {
							mmm = "0" + (dateee.getMonth() + 1)
						} else if (ddd == 1) {
							ddd = "0" + dateee.getDate()
						}
						let tgltransaksii = ddd + ' - ' + mmm + ' - ' + dateee.getFullYear()
						let kode = datahariini[3]
						let ketkode = kode.substring(0, 2)
						let debet = 0
						let kredit = 0
						let ket = ""
						if (ketkode == 'KK') {
							debet = 'Rp. 0'
							kredit = formatRupiah(datahariini[2].toString(), 'Rp. ')
							ket = "kas keluar"
						} else if (ketkode == 'KM') {
							kredit = 'Rp. 0'
							debet = formatRupiah(datahariini[2].toString(), 'Rp. ')
							ket = "kas masuk"
						}
						console.log(data)
						$("#dataKas").append(`<tr>
                                                <td>` + no + `</td>
                                                <td>` + tgltransaksii + `</td>
                                                <td>` + kode + `</td>
                                                <td>` + debet + `</td>
                                                <td>` + kredit + `</td>
                                                <td>
                                                    ` + ket + ` : <br>
                                                    ` + datahariini[1] + `
                                                </td>
                                            </tr>`)

					})

					$("#dataKas").append(`<tr>
                                    <td></td>
                                    <td style="font-size: 15px;font-weight: bold">Total</td>
                                    <td></td>
                                    <td style="font-size: 15px;font-weight: bold">` + formatRupiah(data['data2'][0].toString(), 'Rp. ') + `</td>
                                    <td style="font-size: 15px;font-weight: bold">` + formatRupiah(data['data2'][1].toString(), 'Rp. ') + `</td>
                                    <td style="font-size: 15px;font-weight: bold">Saldo : ` + formatRupiah(data['data2'][2].toString(), 'Rp. ') + `</td>
                                </tr>`)
					$("#tt").html('<p id="tt" style="font-weight: bold; font-size: 30px; margin-top: 30px">TOTAL : ' + formatRupiah(data['data2'][2].toString(), 'Rp. ') + '</p>')
				}
			}
		})
	})
	//bln ini
	$('#lporanbln').click(function() {

		$.ajax({
			url: baseUrl + 'kasumum/blnini',
			type: 'GET',
			beforeSend: function() {
				$("#dataKas").html('')
				$("#dataKas").append(`<tr>
                        <td colspan="6"><center>Loading</center></td>
                    </tr>`)
			},
			success: function(result) {
				let data = JSON.parse(result);
				console.log(data)
				$("#dataKas").html('')
				if (data['data1'].length == 0) {
					$("#dataKas").append(`<tr>
                        <td colspan="6"><center>Data Kosong</center></td>
                    </tr>`)
					$("#tt").html('<p id="tt" style="font-weight: bold; font-size: 30px; margin-top: 30px">TOTAL : ' + formatRupiah("0", 'Rp. ') + '</p>')
				} else {
					let d = new Date()
					// console.log(data);
					let m = (d.getMonth() + 1)
					if (m == 1) {
						m = "0" + (d.getMonth() + 1)
					}
					// console.log(m)
					$("#dataKas").append(`<tr>
                        <td>1</td>
                        <td>01 - ` + m + ` - ` + d.getFullYear() + `</td>
                        <td></td>
                        <td>` + formatRupiah(data['data2'][0].toString(), 'Rp. ') + `</td>
                        <td>` + formatRupiah("0", 'Rp. ') + `</td>
                        <td>Saldo Awal </td>
                    </tr>`)
					let no = 1
					data['data1'].forEach(function(datablnini) {
						no++
						let dateee = new Date(datablnini[0])
						let mmm = (dateee.getMonth() + 1)
						let ddd = dateee.getDate()
						if (mmm == 1) {
							mmm = "0" + (dateee.getMonth() + 1)
						} else if (ddd == 1) {
							ddd = "0" + dateee.getDate()
						}
						let tgltransaksii = ddd + ' - ' + mmm + ' - ' + dateee.getFullYear()
						let kode = datablnini[3]
						let ketkode = kode.substring(0, 2)
						let debet = 0
						let kredit = 0
						let ket = ""
						if (ketkode === 'KK') {
							debet = 'Rp. 0'
							kredit = formatRupiah(datablnini[2].toString(), 'Rp. ')
							ket = "kas keluar"
						} else if (ketkode == 'KM') {
							kredit = 'Rp. 0'
							debet = formatRupiah(datablnini[2].toString(), 'Rp. ')
							ket = "kas masuk"
						}

						$("#dataKas").append(`<tr>
                                            <td>` + no + `</td>
                                            <td>` + tgltransaksii + `</td>
                                            <td>` + kode + `</td>
                                            <td>` + debet + `</td>
                                            <td>` + kredit + `</td>
                                            <td>
                                                ` + ket + ` : <br> 
                                                ` + datablnini[1] + `
                                            </td>
                                        </tr>`)
					})
					$("#dataKas").append(`<tr>
                                    <td></td>
                                    <td style="font-size: 15px;font-weight: bold">Total</td>
                                    <td></td>
                                    <td style="font-size: 15px;font-weight: bold">` + formatRupiah(data['data2'][1].toString(), 'Rp. ') + `</td>
                                    <td style="font-size: 15px;font-weight: bold">` + formatRupiah(data['data2'][2].toString(), 'Rp. ') + `</td>
                                    <td style="font-size: 15px;font-weight: bold">Saldo : ` + formatRupiah(data['data2'][3].toString(), 'Rp. ') + `</td>
                                </tr>`)
					$("#tt").html('<p id="tt" style="font-weight: bold; font-size: 30px; margin-top: 30px">TOTAL : ' + formatRupiah(data['data2'][3].toString(), 'Rp. ') + '</p>')
				}
			}

		})

	})


	//thn ini
	$('#lporanthn').click(function() {
		$.ajax({
			url: baseUrl + 'kasumum/thnini',
			type: 'GET',
			beforeSend: function() {
				$("#dataKas").html('')
				$("#dataKas").append(`<tr>
                        <td colspan="6"><center>Loading</center></td>
                    </tr>`)

			},
			success: function(result) {
				let data = JSON.parse(result);
				$("#dataKas").html('')
				if (data['data1'].length == 0) {
					$("#dataKas").append(`<tr>
                        <td colspan="6"><center>Data Kosong</center></td>
                    </tr>`)
					$("#tt").html('<p id="tt" style="font-weight: bold; font-size: 30px; margin-top: 30px">TOTAL : ' + formatRupiah("0", 'Rp. ') + '</p>')
				} else {
					let d = new Date()
					// console.log(data)
					$("#dataKas").append(`<tr>
                        <td>1</td>
                        <td>01 - 01 - ` + d.getFullYear() + `</td>
                        <td></td>
                        <td>` + formatRupiah(data['data2'][0].toString(), 'Rp. ') + `</td>
                        <td>` + formatRupiah("0", 'Rp. ') + `</td>
                        <td>Saldo Awal </td>
                    </tr>`)
					let no = 1
					data['data1'].forEach(function(datathnini) {
						no++
						let dateee = new Date(datathnini[0])
						let mmm = (dateee.getMonth() + 1)
						let ddd = dateee.getDate()
						if (mmm == 1) {
							mmm = "0" + (dateee.getMonth() + 1)
						} else if (ddd == 1) {
							ddd = "0" + dateee.getDate()
						}
						let tgltransaksii = ddd + ' - ' + mmm + ' - ' + dateee.getFullYear()
						let kode = datathnini[3]
						let ketkode = kode.substring(0, 2)
						let debet = 0
						let kredit = 0
						let ket = ""
						if (ketkode === 'KK') {
							debet = 'Rp. 0'
							kredit = formatRupiah(datathnini[2].toString(), 'Rp. ')
							ket = 'kas keluar'
						} else if (ketkode == 'KM') {
							kredit = 'Rp. 0'
							debet = formatRupiah(datathnini[2].toString(), 'Rp. ')
							ket = 'kas masuk'
						}
						$("#dataKas").append(`<tr>
                                            <td>` + no + `</td>
                                            <td>` + tgltransaksii + `</td>
                                            <td>` + kode + `</td>
                                            <td>` + debet + `</td>
                                            <td>` + kredit + `</td>
                                            <td>
                                                ` + ket + ` : <br>
                                                ` + datathnini[1] + `
                                            </td>
                                        </tr>`)
					})
					$("#dataKas").append(`<tr>
                                    <td></td>
                                    <td style="font-size: 15px;font-weight: bold">Total</td>
                                    <td></td>
                                    <td style="font-size: 15px;font-weight: bold">` + formatRupiah(data['data2'][1].toString(), 'Rp. ') + `</td>
                                    <td style="font-size: 15px;font-weight: bold">` + formatRupiah(data['data2'][2].toString(), 'Rp. ') + `</td>
                                    <td style="font-size: 15px;font-weight: bold">Saldo : ` + formatRupiah(data['data2'][3].toString(), 'Rp. ') + `</td>
                                </tr>`)
					$("#tt").html('<p id="tt" style="font-weight: bold; font-size: 30px; margin-top: 30px">TOTAL : ' + formatRupiah(data['data2'][3].toString(), 'Rp. ') + '</p>')
				}
			}
		})
	})

	//custom
	$('#btnCaridata').click(function() {
		let awal = $('#tglawall').val()
		let akhir = $('#tglakhiree').val()
		let date1 = new Date(awal)
		let datee1 = date1.getDate()
		let month = (date1.getMonth() + 1)
		let year = date1.getFullYear()
		let date2 = new Date(akhir)
		let datee2 = date2.getDate()
		let monthh = (date2.getMonth() + 1)
		let yearr = date2.getFullYear()


		let jmlhbln = 12
		let thn = 28
		if (year % 4 == 0) {
			thn = 29
		}
		let jmlhari = [
			[1, 31],
			[2, thn],
			[3, 31],
			[4, 30],
			[5, 31],
			[6, 30],
			[7, 31],
			[8, 31],
			[9, 30],
			[10, 31],
			[11, 30],
			[12, 31]
		]
		// console.log(awal, akhir)
		if (awal == akhir) {
			$.ajax({
				url: baseUrl + 'kasumum/hariini',
				type: 'GET',
				beforeSend: function() {
					$("#dataKas").html('')
					$("#dataKas").append(`<tr>
                        <td colspan="6"><center>Loading</center></td>
                    </tr>`)
				},
				success: function(result) {
					$("#dataKas").html('')
					let data = JSON.parse(result);
					// console.log(data['data2'])
					if (data['data1'].length == 0) {
						$("#dataKas").append(`<tr>
                        <td colspan="6"><center>Data Kosong</center></td>
                    </tr>`)
						$("#tt").html('<p id="tt" style="font-weight: bold; font-size: 30px; margin-top: 30px">TOTAL : ' + formatRupiah("0", 'Rp. ') + '</p>')
					} else {
						// console.log(data)
						// $("#dataKas").append(`<tr>
						//     <td></td>
						//     <td>Saldo Awal</td>
						//     <td></td>
						//     <td>` + formatRupiah(data['data2'][0].toString(), 'Rp. ') + `</td>
						//     <td>` + 0 + `</td>
						//     <td>` + formatRupiah(data['data2'][0].toString(), 'Rp. ') + `</td>
						// </tr>`)
						let no = 0;
						data['data1'].forEach(function(datahariini) {
							no++
							let dateee = new Date(datahariini[0])
							let mmm = (dateee.getMonth() + 1)
							let ddd = dateee.getDate()
							if (mmm == 1) {
								mmm = "0" + (dateee.getMonth() + 1)
							} else if (ddd == 1) {
								ddd = "0" + dateee.getDate()
							}
							let tgltransaksii = ddd + ' - ' + mmm + ' - ' + dateee.getFullYear()
							let kode = datahariini[3]
							let ketkode = kode.substring(0, 2)
							let debet = 0
							let kredit = 0
							let ket = ""
							if (ketkode == 'KK') {
								debet = 'Rp. 0'
								kredit = formatRupiah(datahariini[2].toString(), 'Rp. ')
								ket = "kas keluar"
							} else if (ketkode == 'KM') {
								kredit = 'Rp. 0'
								debet = formatRupiah(datahariini[2].toString(), 'Rp. ')
								ket = "kas masuk"
							}
							console.log(data)
							$("#dataKas").append(`<tr>
                                                <td>` + no + `</td>
                                                <td>` + tgltransaksii + `</td>
                                                <td>` + kode + `</td>
                                                <td>` + debet + `</td>
                                                <td>` + kredit + `</td>
                                                <td>
                                                    ` + ket + ` : <br>
                                                    ` + datahariini[1] + `
                                                </td>
                                            </tr>`)
						})

						$("#dataKas").append(`<tr>
                                    <td></td>
                                    <td style="font-size: 15px;font-weight: bold">Total</td>
                                    <td></td>
                                    <td style="font-size: 15px;font-weight: bold">` + formatRupiah(data['data2'][0].toString(), 'Rp. ') + `</td>
                                    <td style="font-size: 15px;font-weight: bold">` + formatRupiah(data['data2'][1].toString(), 'Rp. ') + `</td>
                                    <td style="font-size: 15px;font-weight: bold">Saldo : ` + formatRupiah(data['data2'][2].toString(), 'Rp. ') + `</td>
                                </tr>`)
						$("#tt").html('<p id="tt" style="font-weight: bold; font-size: 30px; margin-top: 30px">TOTAL : ' + formatRupiah(data['data2'][2].toString(), 'Rp. ') + '</p>')
					}
				}
			})
		}

		if (year == yearr && month == monthh && datee1 != datee2) {
			let Y_awal = year
			let M_awal = month
			let awal = datee1
			let no = 0
			let a = 0

			let nmr = 1

			let awall = $('#tglawall').val()
			let akhirr = $('#tglakhiree').val()

			$.ajax({
				url: baseUrl + 'kasumum/thnn/' + awall + '/' + akhirr,
				type: 'GET',
				beforeSend: function() {
					$("#dataKas").html('')
					$("#dataKas").append(`<tr>
                        <td colspan="6"><center>Loading</center></td>
                    </tr>`)
					$("#tt").html('<p id="tt" style="font-weight: bold; font-size: 30px; margin-top: 30px">TOTAL : ' + formatRupiah("0", 'Rp. ') + '</p>')
				},
				success: function(result) {
					let data = JSON.parse(result);
					$("#dataKas").html('')
					if (data['data1'].length == 0) {
						$("#dataKas").append(`<tr>
                        <td colspan="6"><center>Data Kosong</center></td>
                    </tr>`)
					} else {
						// console.log(data)
						let date1 = new Date(awall)
						let mm = (date1.getMonth() + 1)
						let dd = date1.getDate()
						if (mm == 1) {
							mm = "0" + (date1.getMonth() + 1)
						} else if (dd == 1) {
							dd = "0" + date1.getDate()
						}
						$("#dataKas").append(`<tr>
                        <td>1</td>
                        <td>` + dd + ' - ' + mm + ' - ' + date1.getFullYear() + `</td>
                        <td></td>
                        <td>` + formatRupiah(data['data2'][0].toString(), 'Rp. ') + `</td>
                        <td>` + formatRupiah("0", 'Rp. ') + `</td>
                        <td>Saldo Awal </td>
                    </tr>`)
						let no = 1
						data['data1'].forEach(function(datathnini) {
							no++
							let dateee = new Date(datathnini[0])
							let mmm = (dateee.getMonth() + 1)
							let ddd = dateee.getDate()
							if (mmm == 1) {
								mmm = "0" + (dateee.getMonth() + 1)
							} else if (ddd == 1) {
								ddd = "0" + dateee.getDate()
							}
							let tgltransaksii = ddd + ' - ' + mmm + ' - ' + dateee.getFullYear()
							let kode = datathnini[3]
							let ketkode = kode.substring(0, 2)
							let debet = 0
							let kredit = 0
							let ket = ""
							if (ketkode === 'KK') {
								debet = 'Rp. 0'
								kredit = formatRupiah(datathnini[2].toString(), 'Rp. ')
								ket = 'kas keluar'
							} else if (ketkode == 'KM') {
								kredit = 'Rp. 0'
								debet = formatRupiah(datathnini[2].toString(), 'Rp. ')
								ket = 'kas masuk'
							}
							$("#dataKas").append(`<tr>
                                            <td>` + no + `</td>
                                            <td>` + tgltransaksii + `</td>
                                            <td>` + kode + `</td>
                                            <td>` + debet + `</td>
                                            <td>` + kredit + `</td>
                                            <td>
                                                ` + ket + ` : <br>
                                                ` + datathnini[1] + `
                                            </td>
                                        </tr>`)
						})
						$("#dataKas").append(`<tr>
                                    <td></td>
                                    <td style="font-size: 15px;font-weight: bold">Total</td>
                                    <td></td>
                                    <td style="font-size: 15px;font-weight: bold">` + formatRupiah(data['data2'][1].toString(), 'Rp. ') + `</td>
                                    <td style="font-size: 15px;font-weight: bold">` + formatRupiah(data['data2'][2].toString(), 'Rp. ') + `</td>
                                    <td style="font-size: 15px;font-weight: bold">Saldo : ` + formatRupiah(data['data2'][3].toString(), 'Rp. ') + `</td>
                                </tr>`)
						$("#tt").html('<p id="tt" style="font-weight: bold; font-size: 30px; margin-top: 30px">TOTAL : ' + formatRupiah(data['data2'][3].toString(), 'Rp. ') + '</p>')
					}
				}
			})


			// for (i = awal; i < datee2 + 1; i++) {
			//     if (i == awal) {
			//         $.ajax({
			//             url: baseUrl+'kasumum/blnini',
			//             type: 'GET',
			//             beforeSend: function() {
			//                 $("#dataKas").html('')
			//                 $("#dataKas").append(`<tr id='l'>
			//                         <td colspan="6"><center>Loading</center></td>
			//                     </tr>`)
			//             },
			//             success: function(result) {
			//                 // $("#l").html('')
			//                 let data = JSON.parse(result)
			//                 $("#dataKas").append(`<tr>
			//                             <td></td>
			//                             <td>Saldo Awal</td>
			//                             <td></td>
			//                             <td>` + formatRupiah(data['data2'][0].toString(), 'Rp. ') + `</td>
			//                             <td>` + 0 + `</td>
			//                             <td>` + formatRupiah(data['data2'][0].toString(), 'Rp. ') + `</td>
			//                         </tr>`)
			//             }
			//         })
			//     } else if (i >= awal || i != datee2) {
			//         $.ajax({
			//             url: baseUrl+'kasumum/bulaniniBy/' + i + '/' + datee2 + '/' + datee1,
			//             type: 'GET',

			//             success: function(result) {
			//                 data = JSON.parse(result);
			//                 let datahariini = []

			//                 if (data['data1'].length != 0) {
			//                     datahariini.push(data['data1'])
			//                     console.log(datahariini)

			//                     if (datahariini[0].length > 1) {
			//                         console.log('hallo')
			//                         datahariini[0].forEach(function(data) {
			//                             let dateee = new Date(data[0])
			//                             let tgltransaksii = dateee.getDate() + ' - ' + (dateee.getMonth() + 1) + ' - ' + dateee.getFullYear()
			//                             let kode = data[3]
			//                             let ketkode = kode.substring(0, 2)
			//                             let debet = 0
			//                             let kredit = 0
			//                             let ket = ""

			//                             if (ketkode === 'KK') {
			//                                 debet = 'Rp. 0'
			//                                 kredit = formatRupiah(data[2].toString(), 'Rp. ')
			//                                 ket = 'kas keluar'
			//                             } else if (ketkode == 'KM') {
			//                                 kredit = 'Rp. 0'
			//                                 debet = formatRupiah(data[2].toString(), 'Rp. ')
			//                                 ket = 'kas masuk'
			//                             }

			//                             $("#dataKas").append(`<tr>
			//                                 <td>` + nmr++ + `</td>
			//                                 <td>` + tgltransaksii + `</td>
			//                                 <td>` + kode + `</td>
			//                                 <td>` + debet + `</td>
			//                                 <td>` + kredit + `</td>
			//                                 <td>
			//                                     ` + ket + ` : <br>
			//                                     ` + data[1] + `
			//                                 </td>
			//                             </tr>`)
			//                         })
			//                     } else if (datahariini[0].length == 1) {

			//                         let dateee = new Date(datahariini[0][0][0])
			//                         let tgltransaksii = dateee.getDate() + ' - ' + (dateee.getMonth() + 1) + ' - ' + dateee.getFullYear()
			//                         let kode = datahariini[0][0][3]
			//                         let ketkode = kode.substring(0, 2)
			//                         let debet = 0
			//                         let kredit = 0
			//                         let ket = ""
			//                         console.log(kode)
			//                         if (ketkode === 'KK') {
			//                             debet = 'Rp. 0'
			//                             kredit = formatRupiah(datahariini[0][0][2].toString(), 'Rp. ')
			//                             ket = 'kas keluar'
			//                         } else if (ketkode == 'KM') {
			//                             kredit = 'Rp. 0'
			//                             debet = formatRupiah(datahariini[0][0][2].toString(), 'Rp. ')
			//                             ket = 'kas masuk'
			//                         }

			//                         $("#dataKas").append(`<tr>
			//                                 <td>` + nmr++ + `</td>
			//                                 <td>` + tgltransaksii + `</td>
			//                                 <td>` + kode + `</td>
			//                                 <td>` + debet + `</td>
			//                                 <td>` + kredit + `</td>
			//                                 <td>
			//                                     ` + ket + `: <br>
			//                                     ` + datahariini[0][0][1] + `
			//                                 </td>
			//                             </tr>`)

			//                     }
			//                 }
			//             }
			//         })
			//         // console.log(i + " : "+datee2)
			//     }
			// }
			// $.ajax({
			//     url: baseUrl+'kasumum/blnini',
			//     type: 'GET',
			//     success: function(result) {
			//         $("#l").html('')
			//         let data = JSON.parse(result)
			//         $("#dataKas").append(`<tr>
			//                             <td></td>
			//                             <td>Total</td>
			//                             <td></td>
			//                             <td>` + formatRupiah(data['data2'][1].toString(), 'Rp. ') + `</td>
			//                             <td>` + formatRupiah(data['data2'][2].toString(), 'Rp. ') + `</td>
			//                             <td>Saldo : ` + formatRupiah(data['data2'][3].toString(), 'Rp. ') + `</td>
			//                         </tr>`)
			//     }
			// })
		}
		if (year == yearr && month != monthh) {
			// console.log('haha')
			let awall = $('#tglawall').val()
			let akhirr = $('#tglakhiree').val()
			let awal = month
			let awal2 = datee1
			// $("#dataKas").html('')
			let nmr = 0
			// let awall = $('#tglawall').val()
			// let akhirr = $('#tglakhiree').val()

			$.ajax({
				url: baseUrl + 'kasumum/thnn/' + awall + '/' + akhirr,
				type: 'GET',
				beforeSend: function() {
					$("#dataKas").html('')
					$("#dataKas").append(`<tr>
                        <td colspan="6"><center>Loading</center></td>
                    </tr>`)
					$("#tt").html('<p id="tt" style="font-weight: bold; font-size: 30px; margin-top: 30px">TOTAL : ' + formatRupiah("0", 'Rp. ') + '</p>')
				},
				success: function(result) {
					let data = JSON.parse(result);
					$("#dataKas").html('')
					if (data['data1'].length == 0) {
						$("#dataKas").append(`<tr>
                        <td colspan="6"><center>Data Kosong</center></td>
                    </tr>`)
					} else {
						let date1 = new Date(awall)
						let mm = (date1.getMonth() + 1)
						let dd = date1.getDate()
						if (mm == 1) {
							mm = "0" + (date1.getMonth() + 1)
						} else if (dd == 1) {
							dd = "0" + date1.getDate()
						}
						$("#dataKas").append(`<tr>
                        <td>1</td>
                        <td>` + dd + ' - ' + mm + ' - ' + date1.getFullYear() + `</td>
                        <td></td>
                        <td>` + formatRupiah(data['data2'][0].toString(), 'Rp. ') + `</td>
                        <td>` + formatRupiah("0", 'Rp. ') + `</td>
                        <td>Saldo Awal </td>
                    </tr>`)
						let no = 1
						data['data1'].forEach(function(datathnini) {
							no++
							let dateee = new Date(datathnini[0])
							let mmm = (dateee.getMonth() + 1)
							let ddd = dateee.getDate()
							if (mmm == 1) {
								mmm = "0" + (dateee.getMonth() + 1)
							} else if (ddd == 1) {
								ddd = "0" + dateee.getDate()
							}
							let tgltransaksii = ddd + ' - ' + mmm + ' - ' + dateee.getFullYear()
							let kode = datathnini[3]
							let ketkode = kode.substring(0, 2)
							let debet = 0
							let kredit = 0
							let ket = ""
							if (ketkode === 'KK') {
								debet = 'Rp. 0'
								kredit = formatRupiah(datathnini[2].toString(), 'Rp. ')
								ket = 'kas keluar'
							} else if (ketkode == 'KM') {
								kredit = 'Rp. 0'
								debet = formatRupiah(datathnini[2].toString(), 'Rp. ')
								ket = 'kas masuk'
							}
							$("#dataKas").append(`<tr>
                                            <td>` + no + `</td>
                                            <td>` + tgltransaksii + `</td>
                                            <td>` + kode + `</td>
                                            <td>` + debet + `</td>
                                            <td>` + kredit + `</td>
                                            <td>
                                                ` + ket + ` : <br>
                                                ` + datathnini[1] + `
                                            </td>
                                        </tr>`)
						})
						$("#dataKas").append(`<tr>
                                    <td></td>
                                    <td style="font-size: 15px;font-weight: bold">Total</td>
                                    <td></td>
                                    <td style="font-size: 15px;font-weight: bold">` + formatRupiah(data['data2'][1].toString(), 'Rp. ') + `</td>
                                    <td style="font-size: 15px;font-weight: bold">` + formatRupiah(data['data2'][2].toString(), 'Rp. ') + `</td>
                                    <td style="font-size: 15px;font-weight: bold">Saldo : ` + formatRupiah(data['data2'][3].toString(), 'Rp. ') + `</td>
                                </tr>`)
						$("#tt").html('<p id="tt" style="font-weight: bold; font-size: 30px; margin-top: 30px">TOTAL : ' + formatRupiah(data['data2'][3].toString(), 'Rp. ') + '</p>')
					}
				}
			})

			// for (i = awal; i < monthh + 1; i++) {

			//     if (i == awal) {
			//         $.ajax({
			//             url: baseUrl+'kasumum/bnnn/' + awall + '/' + akhirr,
			//             type: 'GET',
			//             beforeSend: function() {
			//                 $("#dataKas").html('')
			//                 $("#dataKas").append(`<tr id='l'>
			//                         <td colspan="6"><center>Loading</center></td>
			//                     </tr>`)
			//             },
			//             success: function(result) {
			//                 let data = JSON.parse(result)
			//                 // console.log(data)
			//                 $("#dataKas").append(`<tr>
			//                     <td></td>
			//                     <td>Saldo Awal</td>
			//                     <td></td>
			//                     <td>` + formatRupiah(data[0].toString(), 'Rp. ') + `</td>
			//                     <td>` + 0 + `</td>
			//                     <td>` + formatRupiah(data[0].toString(), 'Rp. ') + `</td>
			//                 </tr>`)
			//             }
			//         })
			//     }
			//     jmlhari.forEach(function(harii) {
			//         let harrri = 0
			//         if (awal == harii[0] && i == harii[0]) {
			//             for (a = awal2; a < harii[1] + 1; a++) {

			//                 harrri = a
			//                 $.ajax({
			//                     url: baseUrl+'kasumum/bnn/' + i + '/' + a,
			//                     type: 'GET',
			//                     success: function(result) {
			//                         data = JSON.parse(result);
			//                         console.log(data)
			//                         let datahariini = []
			//                         if (data.length != 0) {
			//                             datahariini.push(data)
			//                             console.log(datahariini[0])
			//                             if (datahariini[0].length > 1) {
			//                                 datahariini[0].forEach(function(data) {
			//                                     let dateee = new Date(data[0])
			//                                     let tgltransaksii = dateee.getDate() + ' - ' + (dateee.getMonth() + 1) + ' - ' + dateee.getFullYear()
			//                                     let kode = data[3]
			//                                     let ketkode = kode.substring(0, 2)
			//                                     let debet = 0
			//                                     let kredit = 0
			//                                     if (ketkode === 'KK') {
			//                                         debet = 'Rp. 0'
			//                                         kredit = data[2]
			//                                     } else if (ketkode == 'KM') {
			//                                         kredit = 'Rp. 0'
			//                                         debet = data[2]
			//                                     }

			//                                     $("#dataKas").append(`<tr>
			//                                     <td>` + nmr + `</td>
			//                                 <td>` + tgltransaksii + `</td>
			//                                 <td>` + kode + `</td>
			//                                 <td>` + debet + `</td>
			//                                 <td>` + kredit + `</td>
			//                                 <td>` + data[1] + `</td>
			//                             </tr>`)
			//                                 })

			//                             } else if (datahariini[0].length == 1) {
			//                                 let dateee = new Date(datahariini[0][0][0])
			//                                 let tgltransaksii = dateee.getDate() + ' - ' + (dateee.getMonth() + 1) + ' - ' + dateee.getFullYear()
			//                                 let kode = datahariini[0][0][3]
			//                                 let ketkode = kode.substring(0, 2)
			//                                 let debet = 0
			//                                 let kredit = 0
			//                                 if (ketkode === 'KK') {
			//                                     debet = 'Rp. 0'
			//                                     kredit = formatRupiah(datahariini[0][0][2].toString(), 'Rp. ')
			//                                 } else if (ketkode == 'KM') {
			//                                     kredit = 'Rp. 0'
			//                                     debet = formatRupiah(datahariini[0][0][2].toString(), 'Rp. ')
			//                                 }
			//                                 nmr += 1
			//                                 $("#dataKas").append(`<tr>
			//                                 <td>` + nmr + `</td>
			//                                 <td>` + tgltransaksii + `</td>
			//                                 <td>` + kode + `</td>
			//                                 <td>` + debet + `</td>
			//                                 <td>` + kredit + `</td>
			//                                 <td>` + datahariini[0][0][1] + `</td>
			//                             </tr>`)

			//                             }
			//                         }
			//                     }
			//                 })
			//             }
			//         } else if (awal != harii[0] && i == harii[0]) {
			//             for (b = 1; b < datee2 + 1; b++) {

			//                 harrri = b
			//                 $.ajax({
			//                     url: baseUrl+'kasumum/bnn/' + i + '/' + b,
			//                     type: 'GET',
			//                     success: function(result) {
			//                         data = JSON.parse(result);
			//                         let datahariini = []
			//                         if (data.length != 0) {
			//                             datahariini.push(data)
			//                             if (datahariini[0].length > 1) {
			//                                 datahariini[0].forEach(function(data) {
			//                                     let dateee = new Date(data[0])
			//                                     let tgltransaksii = dateee.getDate() + ' - ' + (dateee.getMonth() + 1) + ' - ' + dateee.getFullYear()
			//                                     let kode = data[3]
			//                                     let ketkode = kode.substring(0, 2)
			//                                     let debet = 0
			//                                     let kredit = 0
			//                                     if (ketkode === 'KK') {
			//                                         debet = 'Rp. 0'
			//                                         kredit = data[2]
			//                                     } else if (ketkode == 'KM') {
			//                                         kredit = 'Rp. 0'
			//                                         debet = data[2]
			//                                     }
			//                                     nmr += 1
			//                                     $("#dataKas").append(`<tr>
			//                                     <td>` + nmr + `</td>
			//                                 <td>` + tgltransaksii + `</td>
			//                                 <td>` + kode + `</td>
			//                                 <td>` + debet + `</td>
			//                                 <td>` + kredit + `</td>
			//                                 <td>` + data[1] + `</td>
			//                             </tr>`)
			//                                 })

			//                             } else if (datahariini[0].length == 1) {
			//                                 let dateee = new Date(datahariini[0][0][0])
			//                                 let tgltransaksii = dateee.getDate() + ' - ' + (dateee.getMonth() + 1) + ' - ' + dateee.getFullYear()
			//                                 let kode = datahariini[0][0][3]
			//                                 let ketkode = kode.substring(0, 2)
			//                                 let debet = 0
			//                                 let kredit = 0
			//                                 if (ketkode === 'KK') {
			//                                     debet = 'Rp. 0'
			//                                     kredit = formatRupiah(datahariini[0][0][2].toString(), 'Rp. ')
			//                                 } else if (ketkode == 'KM') {
			//                                     kredit = 'Rp. 0'
			//                                     debet = formatRupiah(datahariini[0][0][2].toString(), 'Rp. ')
			//                                 }
			//                                 nmr += 1
			//                                 $("#dataKas").append(`<tr>
			//                                  <td>` + nmr + `</td>
			//                                 <td>` + tgltransaksii + `</td>
			//                                 <td>` + kode + `</td>
			//                                 <td>` + debet + `</td>
			//                                 <td>` + kredit + `</td>
			//                                 <td>` + datahariini[0][0][1] + `</td>
			//                             </tr>`)

			//                             }
			//                         }
			//                     }
			//                 })
			//                 // console.log(b, datee2)
			//                 if (b == datee2) {
			//                     $.ajax({
			//                         url: baseUrl+'kasumum/bnnn/' + awall + '/' + akhirr,
			//                         type: 'GET',
			//                         success: function(result) {
			//                             $("#l").html('')
			//                             let data = JSON.parse(result)

			//                             $("#dataKas").append(`<tr>
			//                             <td></td>
			//                             <td>Total</td>
			//                             <td></td>
			//                             <td>` + formatRupiah(data[1].toString(), 'Rp. ') + `</td>
			//                             <td>` + formatRupiah(data[2].toString(), 'Rp. ') + `</td>
			//                             <td>Saldo : ` + formatRupiah(data[3].toString(), 'Rp. ') + `</td>
			//                         </tr>`)

			//                         }
			//                     })
			//                 }
			//             }

			//         }
			//     })
			// }


		}
		if (year != yearr) {

			let awall = $('#tglawall').val()
			let akhirr = $('#tglakhiree').val()

			$.ajax({
				url: baseUrl + 'kasumum/thnn/' + awall + '/' + akhirr,
				type: 'GET',
				beforeSend: function() {
					$("#dataKas").html('')
					$("#dataKas").append(`<tr>
                        <td colspan="6"><center>Loading</center></td>
                    </tr>`)
					$("#tt").html('<p id="tt" style="font-weight: bold; font-size: 30px; margin-top: 30px">TOTAL : ' + formatRupiah("0", 'Rp. ') + '</p>')

				},
				success: function(result) {
					let data = JSON.parse(result);
					$("#dataKas").html('')
					if (data['data1'].length == 0) {
						$("#dataKas").append(`<tr>
                        <td colspan="6"><center>Data Kosong</center></td>
                    </tr>`)
					} else {
						let date1 = new Date(awall)
						let mm = (date1.getMonth() + 1)
						let dd = date1.getDate()
						if (mm == 1) {
							mm = "0" + (date1.getMonth() + 1)
						} else if (dd == 1) {
							dd = "0" + date1.getDate()
						}
						$("#dataKas").append(`<tr>
                        <td>1</td>
                        <td>` + dd + ' - ' + mm + ' - ' + date1.getFullYear() + `</td>
                        <td></td>
                        <td>` + formatRupiah(data['data2'][0].toString(), 'Rp. ') + `</td>
                        <td>` + formatRupiah("0", 'Rp. ') + `</td>
                        <td>Saldo Awal </td>
                    </tr>`)
						let no = 1
						data['data1'].forEach(function(datathnini) {
							no++
							let dateee = new Date(datathnini[0])
							let mmm = (dateee.getMonth() + 1)
							let ddd = dateee.getDate()
							if (mmm == 1) {
								mmm = "0" + (dateee.getMonth() + 1)
							} else if (ddd == 1) {
								ddd = "0" + dateee.getDate()
							}
							let tgltransaksii = ddd + ' - ' + mmm + ' - ' + dateee.getFullYear()
							let kode = datathnini[3]
							let ketkode = kode.substring(0, 2)
							let debet = 0
							let kredit = 0
							let ket = ""
							if (ketkode === 'KK') {
								debet = 'Rp. 0'
								kredit = formatRupiah(datathnini[2].toString(), 'Rp. ')
								ket = 'kas keluar'
							} else if (ketkode == 'KM') {
								kredit = 'Rp. 0'
								debet = formatRupiah(datathnini[2].toString(), 'Rp. ')
								ket = 'kas masuk'
							}
							$("#dataKas").append(`<tr>
                                            <td>` + no + `</td>
                                            <td>` + tgltransaksii + `</td>
                                            <td>` + kode + `</td>
                                            <td>` + debet + `</td>
                                            <td>` + kredit + `</td>
                                            <td>
                                                ` + ket + ` : <br>
                                                ` + datathnini[1] + `
                                            </td>
                                        </tr>`)
						})
						$("#dataKas").append(`<tr>
                                    <td></td>
                                    <td style="font-size: 15px;font-weight: bold">Total</td>
                                    <td></td>
                                    <td style="font-size: 15px;font-weight: bold">` + formatRupiah(data['data2'][1].toString(), 'Rp. ') + `</td>
                                    <td style="font-size: 15px;font-weight: bold">` + formatRupiah(data['data2'][2].toString(), 'Rp. ') + `</td>
                                    <td style="font-size: 15px;font-weight: bold">Saldo : ` + formatRupiah(data['data2'][3].toString(), 'Rp. ') + `</td>
                                </tr>`)
						$("#tt").html('<p id="tt" style="font-weight: bold; font-size: 30px; margin-top: 30px">TOTAL : ' + formatRupiah(data['data2'][3].toString(), 'Rp. ') + '</p>')
					}
				}
			})

			// $("#dataKas").html('')
			// for (i = Y_awal; i < yearr + 1; i++) {
			//     if (Y_awal == i) {
			//         for (a = M_awal; a < 13; a++) {
			//             jmlhari.forEach(function(harii) {
			//                 if (M_awal == harii[0] && a == harii[0]) {
			//                     for (b = D_awal; b < harii[1] + 1; b++) {


			//                     }
			//                 } else if (M_awal != harii[0] && a == harii[0]) {
			//                     for (c = 1; c < harii[1] + 1; c++) {

			//                     }
			//                 }

			//             })
			//         }
			//     } else if (Y_awal != i) {
			//         for (a = 1; a < monthh + 1; a++) {
			//             jmlhari.forEach(function(harii) {
			//                 if (monthh != harii[0] && a == harii[0]) {
			//                     for (b = 1; b < harii[1]; b++) {
			//                         // $.get(baseUrl+'kasumum/thnn/' + i + '/' + a + '/' + b, function(result) {
			//                         //     data = JSON.parse(result);
			//                         //     let datahariini = []
			//                         //     if (data.length != 0) {
			//                         //         datahariini.push(data)
			//                         //         let dateee = new Date(datahariini[0][0][0])
			//                         //         let tgltransaksii = dateee.getDate() + ' - ' + (dateee.getMonth() + 1) + ' - ' + dateee.getFullYear()
			//                         //         let kode = datahariini[0][0][3]
			//                         //         let ketkode = kode.substring(0, 2)
			//                         //         let debet = 0
			//                         //         let kredit = 0
			//                         //         if (ketkode === 'KK') {
			//                         //             debet = 'Rp. 0'
			//                         //             kredit = formatRupiah(datahariini[0][0][2].toString(), 'Rp. ')
			//                         //         } else if (ketkode == 'KM') {
			//                         //             kredit = 'Rp. 0'
			//                         //             debet = formatRupiah(datahariini[0][0][2].toString(), 'Rp. ')
			//                         //         }

			//                         //         $("#dataKas").append(`<tr>
			//                         //         <td>` + tgltransaksii + `</td>
			//                         //         <td>` + datahariini[0][0][1] + `</td>
			//                         //         <td>` + debet + `</td>
			//                         //         <td>` + kredit + `</td>
			//                         //         <td>` + formatRupiah(datahariini[0][0][4].toString(), 'Rp. ') + `</td>
			//                         //     </tr>`)
			//                         //         // $("#dataKas").append(`<tr>
			//                         //         //                         <td></td>
			//                         //         //                         <td>Saldo Akhir</td>
			//                         //         //                         <td>` + formatRupiah(dbet.toString(), 'Rp. ') + `</td>
			//                         //         //                         <td>` + formatRupiah(krdii.toString(), 'Rp. ') + `</td>
			//                         //         //                         <td>` + formatRupiah(sldo.toString(), 'Rp. ') + `</td>
			//                         //         //                     </tr>`)
			//                         //     }
			//                         // })
			//                     }
			//                 } else if (monthh == harii[0] && a == harii[0]) {
			//                     for (c = 1; c < datee2; c++) {
			//                         // $.get(baseUrl+'kasumum/thnn/' + i + '/' + a + '/' + c, function(result) {
			//                         //     data = JSON.parse(result);
			//                         //     let datahariini = []
			//                         //     if (data.length != 0) {
			//                         //         datahariini.push(data)
			//                         //         let dateee = new Date(datahariini[0][0][0])
			//                         //         let tgltransaksii = dateee.getDate() + ' - ' + (dateee.getMonth() + 1) + ' - ' + dateee.getFullYear()
			//                         //         let kode = datahariini[0][0][3]
			//                         //         let ketkode = kode.substring(0, 2)
			//                         //         let debet = 0
			//                         //         let kredit = 0
			//                         //         if (ketkode === 'KK') {
			//                         //             debet = 'Rp. 0'
			//                         //             kredit = formatRupiah(datahariini[0][0][2].toString(), 'Rp. ')
			//                         //         } else if (ketkode == 'KM') {
			//                         //             kredit = 'Rp. 0'
			//                         //             debet = formatRupiah(datahariini[0][0][2].toString(), 'Rp. ')
			//                         //         }

			//                         //         $("#dataKas").append(`<tr>
			//                         //         <td>` + tgltransaksii + `</td>
			//                         //         <td>` + datahariini[0][0][1] + `</td>
			//                         //         <td>` + debet + `</td>
			//                         //         <td>` + kredit + `</td>
			//                         //         <td>` + formatRupiah(datahariini[0][0][4].toString(), 'Rp. ') + `</td>
			//                         //     </tr>`)
			//                         //         // $("#dataKas").append(`<tr>
			//                         //         //                         <td></td>
			//                         //         //                         <td>Saldo Akhir</td>
			//                         //         //                         <td>` + formatRupiah(dbet.toString(), 'Rp. ') + `</td>
			//                         //         //                         <td>` + formatRupiah(krdii.toString(), 'Rp. ') + `</td>
			//                         //         //                         <td>` + formatRupiah(sldo.toString(), 'Rp. ') + `</td>
			//                         //         //                     </tr>`)
			//                         //     }
			//                         // })
			//                     }
			//                 }
			//             })
			//         }
			//     }
			// }
		}

	})

	// ./modul/FORMAT IMPORT EXCEL.xlsx
</script>
<!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
</body>

</html>