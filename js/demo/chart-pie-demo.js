// Configuração de fonte e cor padrão do Chart.js
Chart.defaults.global.defaultFontFamily = 'Nunito, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Inicialização do gráfico de pizza (donut)
var ctx = document.getElementById("myPieChart").getContext('2d');
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Original", "Guaraná", "Citrus", "Tropical", "Zero", "Energy", "Nitro"],
    datasets: [{
      data: [21, 8, 11, 12, 19, 14, 15],
      backgroundColor: ['#4e73df', '#7DCE13', '#F4D35E', '#FF6F61', '#B0B0B0', '#FF4500', '#8A2BE2'],
      hoverBackgroundColor: ['#2e59d9', '#5AA10E', '#E4C048', '#E85C50', '#909090', '#CC3700', '#6A1BBE'],
      hoverBorderColor: "rgba(234, 236, 244, 1)"
    }]
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
      caretPadding: 10
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80
  }
});
