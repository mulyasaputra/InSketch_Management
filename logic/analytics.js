// The total number of expenses
const data = {
  labels: labels,
  datasets: [
    {
      label: new Date().getFullYear(),
      backgroundColor: "rgb(249, 19, 147)",
      borderColor: "rgb(249, 19, 147)",
      data: thisYear,
    },
    {
      label: (Tahun = new Date().getFullYear() - 1),
      backgroundColor: "rgb(148, 0, 211)",
      borderColor: "rgb(148, 0, 211)",
      data: lastYear,
    },
  ],
};
const config = {
  type: "line",
  data,
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0,
      },
    },
    scales: {
      x: {
        grid: {
          borderColor: "red",
        },
      },
    },
  },
};
const myChart = new Chart(document.getElementById("expensesValue"), config);

// The total amount of money spent
function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + "").replace(",", "").replace(" ", "");
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
    dec = typeof dec_point === "undefined" ? "." : dec_point,
    s = "",
    toFixedFix = function (n, prec) {
      var k = Math.pow(10, prec);
      return "" + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || "").length < prec) {
    s[1] = s[1] || "";
    s[1] += new Array(prec - s[1].length + 1).join("0");
  }
  return s.join(dec);
}

var ctx = document.getElementById("amountValue");
var myLineChart = new Chart(ctx, {
  type: "line",
  data: {
    labels: labels,
    datasets: [
      {
        label: new Date().getFullYear(),
        backgroundColor: "rgb(249, 19, 147)",
        borderColor: "rgb(249, 19, 147)",
        data: thisEarnings,
      },
      {
        label: (Tahun = new Date().getFullYear() - 1),
        backgroundColor: "rgb(148, 0, 211)",
        borderColor: "rgb(148, 0, 211)",
        data: lasEarnings,
      },
    ],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0,
      },
    },
    scales: {
      xAxes: [
        {
          time: {
            unit: "date",
          },
          gridLines: {
            display: false,
            drawBorder: false,
          },
          ticks: {
            maxTicksLimit: 7,
          },
        },
      ],
      yAxes: [
        {
          ticks: {
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function (value, index, values) {
              return "Rp. " + number_format(value);
            },
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2],
          },
        },
      ],
    },
    legend: {
      display: false,
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: "#6e707e",
      titleFontSize: 14,
      borderColor: "#dddfeb",
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: "index",
      caretPadding: 10,
      callbacks: {
        label: function (tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || "";
          return datasetLabel + ": Rp. " + number_format(tooltipItem.yLabel);
        },
      },
    },
  },
});
