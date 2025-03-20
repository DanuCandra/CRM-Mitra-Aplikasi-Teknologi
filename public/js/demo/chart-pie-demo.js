// Set default font family dan warna seperti di SB Admin 2
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Ambil elemen canvas
var ctx = document.getElementById("prospectSourceChart");

if (ctx) { // Pastikan elemen ada di halaman
    var advertising = ctx.getAttribute("data-advertising");
    var socialMedia = ctx.getAttribute("data-social-media");
    var directCall = ctx.getAttribute("data-direct-call");
    var search = ctx.getAttribute("data-search");

    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Advertising", "Social Media", "Direct Call", "Search"],
            datasets: [{
                data: [advertising, socialMedia, directCall, search],
                backgroundColor: ['#4e73df', '#1cc88a', '#e74a3b', '#f6c23e'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#be2617', '#e0ac21'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: true
            },
            cutoutPercentage: 70,
        },
    });
}
