$(function() {
    $.ajax({
        url: '../../ajax/getMapData.ajax.php',
        method: "POST",
        success:function(data){
            var religionByCountry = data;
            var prevailingReligionVal = 0;
            var countryColor = "";

            //loop through all countries
            for (let country in religionByCountry) {
                var countryData = religionByCountry[country];
                
                //determine prevailing religion of each country
                for (let religion in countryData) {
                    if (countryData[religion] > prevailingReligionVal) {
                        prevailingReligionVal = countryData[religion];
                        prevailingReligion = religion;

                        //set color of country to assigned color of prevailing religion
                        switch(prevailingReligion){
                            case "Buddhism":
                                countryColor = "#BAA400";
                                break;
                            case "Christianity":
                                countryColor = "#56097A";
                                break;
                            case "Hinduism":
                                countryColor = "#A81315";
                                break;
                            case "Islam":
                                countryColor = "#018744";
                                break;
                            case "Judaism":
                                countryColor = "#1334A8";
                                break;
                            case "Others":
                                countryColor = "#B37100";
                                break;
                            case "Non-Religious":
                                countryColor = "#242424";
                                break;
                        }
                    }
                }
                document.getElementById(country).style.fill = countryColor;
                prevailingReligionVal = 0;
            }

            var allCountries = document.getElementsByTagName("g");
            var chart;

            //highlight countries on hover and display content
            const countryHover = country => {
                var currentCountry = country.target.parentElement.id;
                document.getElementById(currentCountry).style.opacity = 0.5; 
                document.getElementById(currentCountry).setAttribute("data-toggle", "popover");
                document.getElementById(currentCountry).setAttribute("data-html", "true");

                //get total population
                var totalPopulation = 0;
                var prevailingReligionPercentage = 0;
                var prevailingReligionVal = 0;

                for (let country in religionByCountry) {
                    if (country == currentCountry){
                        var countryData = religionByCountry[country];

                        for (let religion in countryData) {
                            totalPopulation += countryData[religion];
    
                            if (countryData[religion] > prevailingReligionVal) {
                                prevailingReligionVal = countryData[religion];
                                prevailingReligion = religion;
                            }    
                        }

                        prevailingReligionPercentage = (Math.round(((prevailingReligionVal / totalPopulation) * 100) * 100) / 100).toFixed(2);
                    }
                }

                $('[data-toggle = "popover"]').popover({
                    title: currentCountry, 
                    content: "The prevailing religion in " + currentCountry + " is " + prevailingReligion + ", comprising " + prevailingReligionPercentage + "% of the population.",
                    placement: "top"
                });
                $('[data-toggle = "popover"]').popover("show");
            }
        
            // remove highlight and hide content
            const countryOut = country => {
                var currentCountry = country.target.parentElement.id;
                document.getElementById(currentCountry).style.opacity = 1.0;
                document.getElementById(currentCountry).removeAttribute("data-toggle", "popover");
                $('.popover').popover('dispose');
            }

            const countryClick = country => {
                var currentCountry = country.target.parentElement.id;

                //generate chart
                // Chart.register(ChartDataLabels);
                Chart.defaults.font.family = "Lexend Deca";
                var religionChart = document.getElementById("religionChart").getContext("2d");

                var religions = [];
                var religionData = [];
                var religionColors = ["#BAA400", "#56097A", "#A81315", "#018744", "#1334A8", "#B37100", "#242424"];
        
                for (let country in religionByCountry) {
                    var countryData = religionByCountry[country];
        
                    if (country == currentCountry){
                        for (let religion in countryData) {
                            religions.push(religion);
                            religionData.push(countryData[religion]);
                        }
                    }
        
                }

                configuration = {
                    type: "bar",
                    data: {
                        labels: religions,
                        datasets: [{
                            data: religionData,
                            backgroundColor: religionColors
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        plugins: {
                            // datalabels: {
                            //     anchor: "end",
                            //     align: "top",
                            //     formatter: Math.round,
                            //     font: {
                            //         size: 12
                            //     }
                            // },
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    maxRotation: 0,
                                    minRotation: 0
                                }
                            }
                        },
                        layout: {
                            padding: 25
                        },
                        animation: false
                    }
                };

                if (chart) {
                    chart.destroy();
                    chart = new Chart(religionChart, configuration);
                } else {
                    chart = new Chart(religionChart, configuration);
                }

                $('#modalTitle').text(currentCountry);
                $('#countryInformationModal').modal();
            }
        
            for (let country of allCountries) {
                country.addEventListener("mouseover", countryHover);
                country.addEventListener("mouseout", countryOut);
                country.addEventListener("click", countryClick);
            }
        }
    });
});