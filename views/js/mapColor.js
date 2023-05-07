$(function() {

    //sample values only
    var sampleData = {
        Brunei : {
            Buddhism: 30000,
            Christianity: 40000,
            Hinduism: 5000,
            Islam: 300000,
            Judaism: 5000,
            Others: 25000,
            NonReligious: 5000
        },
    
        Cambodia : {
            Buddhism: 13690000,
            Christianity: 50000,
            Hinduism: 5000,
            Islam: 280000,
            Judaism: 5000,
            Others: 85000,
            NonReligious: 30000
        },
    
        Indonesia : {
            Buddhism: 1720000,
            Christianity: 23660000,
            Hinduism: 4050000,
            Islam: 209120000,
            Judaism: 5000,
            Others: 1090000,
            NonReligious: 240000
        },
    
        Laos : {
            Buddhism: 4100000,
            Christianity: 90000,
            Hinduism: 5000,
            Islam: 5000,
            Judaism: 5000,
            Others: 1960000,
            NonReligious: 50000
        },
    
        Malaysia : {
            Buddhism: 5010000,
            Christianity: 2670000,
            Hinduism: 1720000,
            Islam: 18100000,
            Judaism: 5000,
            Others: 710000,
            NonReligious: 190000
        },
    
        Myanmar : {
            Buddhism: 38410000,
            Christianity: 3750000,
            Hinduism: 820000,
            Islam: 1900000,
            Judaism: 5000,
            Others: 2840000,
            NonReligious: 240000
        },
    
        Philippines : {
            Buddhism: 80000,
            Christianity: 86370000,
            Hinduism: 5000,
            Islam: 5150000,
            Judaism: 5000,
            Others: 1560000,
            NonReligious: 90000
        },
    
        // Singapore : {
        //     Buddhism: 1730000,
        //     Christianity: 920000,
        //     Hinduism: 260000,
        //     Islam: 730000,
        //     Judaism: 5000,
        //     Others: 610000,
        //     NonReligious: 830000
        // },
    
        Thailand : {
            Buddhism: 64420000,
            Christianity: 600000,
            Hinduism: 70000,
            Islam: 3770000,
            Judaism: 5000,
            Others: 65000,
            NonReligious: 190000
        },
    
        TimorLeste : {
            Buddhism: 5000,
            Christianity: 1120000,
            Hinduism: 5000,
            Islam: 5000,
            Judaism: 5000,
            Others: 10000,
            NonReligious: 5000
        },
    
        Vietnam : {
            Buddhism: 14380000,
            Christianity: 7170000,
            Hinduism: 5000,
            Islam: 160000,
            Judaism: 5000,
            Others: 40100000,
            NonReligious: 26040000
        }
    }

    var prevailingReligionVal = 0;
    var countryColor = "";

    //loop through all countries
    for (let country in sampleData) {
        var countryData = sampleData[country];
        
        //determine prevailing religion of each country
        for (let religion in countryData) {
            if (countryData[religion] > prevailingReligionVal) {
                prevailingReligionVal = countryData[religion];
                prevailingReligion = religion;

                //set color of country to assigned color of prevailing religion
                switch(prevailingReligion){
                    case "Buddhism":
                        countryColor = "#FF0000"; //red
                        break;
                    case "Christianity":
                        countryColor = "#FFA500"; //orange
                        break;
                    case "Hinduism":
                        countryColor = "#FFFF00"; //yellow
                        break;
                    case "Islam":
                        countryColor = "#00FF00"; //green
                        break;
                    case "Judaism":
                        countryColor = "#0000FF"; //blue
                        break;
                    case "Others":
                        countryColor = "#8F00FF"; //violet
                        break;
                    case "NonReligious":
                        countryColor = "#808080"; //gray
                        break;
                }
            }
        }

        document.getElementById(country).style.fill = countryColor;
        prevailingReligionVal = 0;
    }

    var allCountries = document.getElementsByTagName('g');

    //highlight countries on hover and display content
    const countryHover = country => {
        var currentCountry = country.target.parentElement.id;
        document.getElementById(currentCountry).style.opacity = 0.5;

        // document.getElementById(currentCountry).popover({
        //     trigger: "manual",
        //     container: "body",
        //     title: "", 
        //     content: ""
        // });
        // document.getElementById(currentCountry).popover("show");
    }

    const countryOut = country => {
        var currentCountry = country.target.parentElement.id;
        document.getElementById(currentCountry).style.opacity = 1.0;

        // document.getElementById(currentCountry).popover("destroy");
    }

    for (let country of allCountries) {
        country.addEventListener("mouseover", countryHover);
        country.addEventListener("mouseout", countryOut);
    }


});