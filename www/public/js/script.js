/********************************************/
/************** CHAR.JS ADMIN ***************/
/*******************************************/
$(function(){


  setNavigation();
  /*******************************************/
  /************** CHAR LINE ***************/
  /*******************************************/
  var ctx = document.getElementById("myChart").getContext('2d');
  var myChart = new Chart(ctx, {
  type: 'line',
  data: {
      labels: ["1", "2", "3", "4", "5", "6"],
      datasets: [{
          label: 'Nombre de visites',
          data: [2, 4, 12, 6, 7, 5],
          backgroundColor: [
           'rgba(255, 99, 132, 0.5)',
           'rgba(54, 162, 235, 0.5)',
           'rgba(255, 206, 86, 0.5)',
           'rgba(75, 192, 192, 0.5)',
           'rgba(153, 102, 255, 0.5)',
           'rgba(255, 159, 64, 0.5)'
          ],
          borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
      }]
  },
  options: {
      scales: {
          yAxes: [{
              ticks: {
                  beginAtZero:true,
                  max: 20
              }
          }]
      },
      legend: {
          labels: {
              fontColor: "black",
              fontSize: 18
          }
      },
      responsive: true
  }
  });
  /*******************************************/
  /************** CHAR BAR ***************/
  /*******************************************/
  var ctx = document.getElementById("myChart2").getContext('2d');
  var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
      labels: ["1", "2", "3", "4", "5", "6"],
      datasets: [{
          label: 'Durée des visites',
          data: [2, 4, 12, 6, 7, 5],
          backgroundColor: [
           'rgba(255, 99, 132, 0.5)',
           'rgba(54, 162, 235, 0.5)',
           'rgba(255, 206, 86, 0.5)',
           'rgba(75, 192, 192, 0.5)',
           'rgba(153, 102, 255, 0.5)',
           'rgba(255, 159, 64, 0.5)'
          ],
          borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
      }]
  },
  options: {
      scales: {
          yAxes: [{
              ticks: {
                  beginAtZero:true,
                  max: 20
              }
          }]
      },
      legend: {
          labels: {
              fontColor: "black",
              fontSize: 18
          }
      },
      responsive: true
  }
  });
  /*******************************************/
  /************** CHAR BAR ***************/
  /*******************************************/
  var ctx = document.getElementById("myChart3").getContext('2d');
  var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
      labels: ["Ancien visiteur", "Nouveau visiteur"],
      datasets: [{
          label: 'Nombre de visites',
          data: [25,75],
          backgroundColor: [
           'rgba(255, 99, 132, 0.5)',
           'rgba(54, 162, 235, 0.5)',
           'rgba(255, 206, 86, 0.5)',
           'rgba(75, 192, 192, 0.5)',
           'rgba(153, 102, 255, 0.5)',
           'rgba(255, 159, 64, 0.5)'
          ],
          borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
      }]
  },
  options: {
      scales: {
          yAxes: [{
              ticks: {
                  beginAtZero:true,
                  max: 20
              }
          }]
      },
      legend: {
          labels: {
              fontColor: "black",
              fontSize: 18
          }
      },
      responsive: true
    }
  });



  /*******************************************/
  /************** Sticky Menu ***************/
  /*******************************************/
  $(window).scroll(function(){
    var window_position = $(window).scrollTop();
    if(window_position > 0){
        $('.top-header').addClass('sticky');
    }else{
        $('.top-header').removeClass('sticky');
    }
    var hauteurWindow = $(window).height();
    console.log(hauteurWindow);
  });

}); // ready
/*******************************************/
/************** Active Menu ***************/
/*******************************************/
function setNavigation() {
    var path = window.location.pathname;
    path = path.replace(/\/$/, "");
    path = decodeURIComponent(path);

    $(".link").each(function () {
        var href = $(this).attr('href');
        if (path.substring(0, href.length) === href) {
            $(this).closest('li').addClass('active');
        }else{
          $(this).closest('li').removeClass('active');
        }
    });
}
