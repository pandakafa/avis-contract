var token = $("meta[name=token").attr("content");
var url = $("base").attr("href");

$(".price").inputmask({
	alias: "currency",
	groupSeparator: ".",
	autoGroup: true,
	digits: 2,
	radixPoint: ".",
	digitsOptional: false,
	allowMinus: false,
	prefix: "",
	rightAlign: false,
});

$("#loginForm").submit(function (event) {
	event.preventDefault();
	var formData = new FormData(this);
	formData.append("process", "login");

	$.ajax({
		url: url + "/ajax",
		data: formData,
		type: "POST",
		dataType: "json",
		contentType: false,
		processData: false,
		success: function (response) {
			Swal.fire({
				icon: response.status,
				title: response.title,
				text: response.message,
				timer: 1500,
				timerProgressBar: true,
				showConfirmButton: false,
			}).then(function () {
				window.location.href = response.redirected;
			});
		},
		error: function (response) {
			console.log(response.message);
		},
	});
});

var dataTable = $("#cars").DataTable({
	processing: true,
	serverSide: true,
	lengthChange: true,
	pageLength: 25,
	order: [],
	searching: true,
	columnDefs: [
		{
			targets: [0, 1, 2, 3, 4, 5, 6],
			orderable: false,
		},
	],
	columns: [{}, {}, {}, {}, {}, {}, { width: "7%" }],
	rowCallback: function (row, data, displayNum, displayIndex, dataIndex) {},
	language: {
		url: url + "/assets/js/Turkish.json",
	},
	ajax: {
		url: url + "/ajax",
		type: "POST",
		data: { token: token, process: "cars-table" },
	},
});

$("#newCar").submit(function (event) {
	event.preventDefault();

	var formData = new FormData(this);
	formData.append("process", "newCar");

	$.ajax({
		url: url + "/ajax",
		data: formData,
		type: "POST",
		dataType: "json",
		contentType: false,
		processData: false,
		success: function (response) {
			Swal.fire({
				icon: response.status,
				title: response.title,
				text: response.message,
				timer: 1500,
				timerProgressBar: true,
				showConfirmButton: false,
			}).then(function () {
				window.location.href = response.redirected;
			});
		},
		error: function (response) {
			console.log(response.message);
		},
	});
});

$("#editCar").submit(function (event) {
	event.preventDefault();

	var formData = new FormData(this);
	formData.append("process", "editCar");

	$.ajax({
		url: url + "/ajax",
		data: formData,
		type: "POST",
		dataType: "json",
		contentType: false,
		processData: false,
		success: function (response) {
			Swal.fire({
				icon: response.status,
				title: response.title,
				text: response.message,
				timer: 1500,
				timerProgressBar: true,
				showConfirmButton: false,
			}).then(function () {
				window.location.href = response.redirected;
			});
		},
		error: function (response) {
			console.log(response.message);
		},
	});
});

var dataTable = $("#invoice").DataTable({
	processing: true,
	serverSide: true,
	lengthChange: true,
	pageLength: 25,
	order: [],
	searching: true,
	columnDefs: [
		{
			targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
			orderable: false,
		},
	],
	columns: [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, { width: "7%" }],
	rowCallback: function (row, data, displayNum, displayIndex, dataIndex) {},
	language: {
		url: url + "/assets/js/Turkish.json",
	},
	ajax: {
		url: url + "/ajax",
		type: "POST",
		data: { token: token, process: "invoice-table" },
	},
});

$("#newInvoice").submit(function (event) {
	event.preventDefault();
	$(".loadingForm").show();

	var formData = new FormData(this);
	formData.append("process", "newInvoice");

	$.ajax({
		url: url + "/ajax",
		data: formData,
		type: "POST",
		dataType: "json",
		contentType: false,
		processData: false,
		success: function (response) {
			$(".loadingForm").hide();
			Swal.fire({
				icon: response.status,
				title: response.title,
				text: response.message,
				timer: 1500,
				timerProgressBar: true,
				showConfirmButton: false,
			}).then(function () {
				window.location.href = response.redirected;
			});
		},
		error: function (response) {
			console.log(response.message);
		},
	});
});

$("#editInvoice").submit(function (event) {
	event.preventDefault();
	$(".loadingForm").show();

	var formData = new FormData(this);
	formData.append("process", "editInvoice");

	$.ajax({
		url: url + "/ajax",
		data: formData,
		type: "POST",
		dataType: "json",
		contentType: false,
		processData: false,
		success: function (response) {
			$(".loadingForm").hide();
			Swal.fire({
				icon: response.status,
				title: response.title,
				text: response.message,
				timer: 1500,
				timerProgressBar: true,
				showConfirmButton: false,
			}).then(function () {
				window.location.href = response.redirected;
			});
		},
		error: function (response) {
			console.log(response.message);
		},
	});
});

$(".select-car").change(function () {
	var id = $(this).val();
	$.ajax({
		url: url + "/ajax",
		data: {
			process: "selectCar",
			id: id,
			token: token,
		},
		type: "POST",
		dataType: "json",
		success: function (response) {
			$(".daily_fee").val(response.daily_fee);
		},
		error: function (response) {
			console.log(response.message);
		},
	});
});

$("table").on("click", ".deleteTable", function () {
	var id = $(this).attr("data-id");
	var table = $(this).attr("data-table");

	Swal.fire({
		title: "Veri Silinecek",
		text: "Bu Veriyi Silmek istediğine Emin misin ?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Eminim, Silinsin !",
		cancelButtonText: "İptal Et",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: url + "/ajax",
				data: {
					process: "deleteTable",
					id: id,
					table: table,
					token: token,
				},
				type: "POST",
				dataType: "json",
				success: function (response) {
					if (response.status == "success") {
						$("#" + table)
							.DataTable()
							.ajax.reload();
					}
				},
			});
		}
	});
});

$('[name="rental_start"], [name="rental_end"]').change(function () {
	var rentalStart = new Date($('[name="rental_start"]').val());
	var rentalEnd = new Date($('[name="rental_end"]').val());

	if (rentalEnd <= rentalStart) {
		Swal.fire({
			icon: "error",
			title: "Hata!",
			text: "Bitiş tarihi, başlangıç tarihinden önce olamaz.",
			timer: 1500,
			timerProgressBar: true,
			showConfirmButton: false,
		}).then(function () {
			$('[name="rental_start"], [name="rental_end"]').val("");
		});
	}
});

$(".mainLeftMenu ul li").hover(
	function () {
		$("ul", this).stop().slideDown(200);
	},
	function () {
		$("ul", this).stop().slideUp(200);
	}
);

$(document).on("click", function (e) {
	if (!$(e.target).closest(".mainLeftMenu").length) {
		$(".mainLeftMenu ul ul").slideUp(200);
	}
});
