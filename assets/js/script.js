const btnAdd = document.querySelector(".add");
const form = document.querySelector(".form");
const cloneBody = document.querySelector(".clone-body");
const btnStat = document.querySelector(".stat");
const containerStat = document.querySelector(".container-stat");

btnAdd.addEventListener("click", () => {
  if (!btnStat.classList.contains("active")) {
    btnAdd.classList.toggle("active");
    form.classList.toggle("active");
    cloneBody.classList.toggle("active");
  }
});

btnStat.addEventListener("click", () => {
  if (!btnAdd.classList.contains("active")) {
    btnStat.classList.toggle("active");
    containerStat.classList.toggle("active");
    cloneBody.classList.toggle("active");
  }
});

const chart1 = document.getElementById("stat1");
const chart2 = document.getElementById("stat2");

new Chart(chart1, {
  type: "line",
  data: {
    labels: ["Red", "Blue", "Yellow", "Green", "Purple"],
    datasets: [
      {
        label: "# of Votes",
        data: [34000, 25789, 50000, 24567, 34567, 67890, 12345, 123456],
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

new Chart(chart2, {
  type: "line",
  data: {
    labels: ["Red", "Blue", "Yellow", "Green", "Purple"],
    datasets: [
      {
        label: "# of Votes",
        data: [34000, 25789, 50000, 24567, 34567, 67890, 12345, 123456],
        borderWidth: 1,
        backgroundColor: "blue",
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

