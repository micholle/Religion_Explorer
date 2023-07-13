$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#mapSidebar").html(data);
            $(".sidebar").toggleClass("active");
            $("#text").css("display", "none");
            $("#minmax").attr("src", "../assets/img/maximize.png");
            $(".pageContainer").css("padding-left", "85px");
        }
    });

    //initiate colors
    var religionColors = {
        "Buddhism" : "#BAA400",
        "Christianity" : "#56097A",
        "Hinduism" : "#A81315",
        "Islam" : "#018744",
        "Judaism" : "#1334A8",
        "Other Religions" : "#B37100",
        "Non-Religious" : "#242424"};
    var buddhismColors = {
        "0% - 20%" : "#F1ECCC",
        "20% - 40%" : "#E3DA99",
        "40% - 60%" : "#D5C866",
        "60% - 80%" : "#C7B632",
        "80% - 100%" : "#BAA400"};
    var christianityColors = {
        "0% - 20%" : "#DDCDE4",
        "20% - 40%" : "#BB9CC9",
        "40% - 60%" : "#996BAF",
        "60% - 80%" : "#773A94",
        "80% - 100%" : "#56097A"};
    var hinduismColors = {
        "0% - 20%" : "#EDCFD0",
        "20% - 40%" : "#DCA0A1",
        "40% - 60%" : "#CA7172",
        "60% - 80%" : "#B94243",
        "80% - 100%" : "#A81315"};
    var islamColors = {
        "0% - 20%" : "#CCE7D9",
        "20% - 40%" : "#99CFB4",
        "40% - 60%" : "#66B78E",
        "60% - 80%" : "#339F69",
        "80% - 100%" : "#018744"};
    var judaismColors = {
        "0% - 20%" : "#CFD6ED",
        "20% - 40%" : "#A0ADDC",
        "40% - 60%" : "#7185CA",
        "60% - 80%" : "#425CB9",
        "80% - 100%" : "#1334A8"};
    var otherreligionsColors = {
        "0% - 20%" : "#EFE2CC",
        "20% - 40%" : "#E0C699",
        "40% - 60%" : "#D1A966",
        "60% - 80%" : "#C28D32",
        "80% - 100%" : "#B37100"};
    var nonreligiousColors = {
        "0% - 20%" : "#D3D3D3",
        "20% - 40%" : "#A7A7A7",
        "40% - 60%" : "#7B7B7B",
        "60% - 80%" : "#4F4F4F",
        "80% - 100%" : "#242424"};

    //timeline values
    var religionStart = {
        "Buddhism" : -490,
        "Christianity" : -2100,
        "Hinduism" : -2500,
        "Islam" : 540,
        "Judaism" : -2000
    }

    //initialize default filter and timeline
    var religionFilter = "All Religions";
    var timelineYear = "2020 CE";

    //change map data based on filter
    $('#religionFilterOptions').click(function(){
        if($('#religionFilterOptions').val() != religionFilter){
            religionFilter = $('#religionFilterOptions').val();
            mapTimeline(religionFilter);
            mapColor(religionFilter, timelineYear);
            mapPin(religionFilter, timelineYear);
        }
    });

    //initialize map
    $("#timelineOverlayYear").text(timelineYear);
    $("#timelineOverlay").css("display", "block");
    mapTimeline(religionFilter);
    mapColor(religionFilter, timelineYear);
    mapPin(religionFilter, timelineYear);

    //change map data based on timeline
    function changeTimeline() {
        var timelineYears = document.getElementsByName("timelineValue");
        for (i = 0; i < timelineYears.length; i++) {
            if (timelineYears[i].checked){
                if(timelineYears[i].value != timelineYear){
                    timelineYear = timelineYears[i].value;
                    break;
                }
            }
        }
    
        mapColor(religionFilter, timelineYear);
        mapPin(religionFilter, timelineYear);
    
        $("#timelineOverlayYear").text(timelineYear);
        $("#timelineOverlay").css("display", "block");

        //do not show overlay if the same year is clicked
    }

    $("#timelineOverlay").click(function () { 
        $("#timelineOverlay").css("display", "none");
    });

    function mapTimeline(religionFilter) {
        //set timeline based on filter
        const timelineSlider = $('#mapSlider');
        const timelineOptions = $('#sliderOptions').empty();
        const timelinePrev = $('<div>').attr("id", "timelinePrev").addClass("timelinePrev").text("<");
        const timelineNext = $('<div>').attr("id", "timelineNext").addClass("timelineNext").text(">");

        function addTimelineOption(year) {
            if (year < 0){
                year = year.toString();
                year = year.substr(1) + " BCE";
            } else {
                year = year + " CE"; 
            }
            
            timelineSlider.show();
            const optionDiv = $('<div>').addClass('timelineOption');
            const input = $('<input>').attr({
                type: 'radio',
                name: 'timelineValue',
                id: year,
                value: year
            }).on('click', changeTimeline);

            const optionLabel = $('<label>').attr('for', year).text(year);
            
            optionDiv.append(input, optionLabel);
            timelineOptions.append(optionDiv);
        }

        //set timeline
        var earliestReligionVal = 0;
        var majorReligion = false;

        for (let religion in religionStart) {
            if (religionStart[religion] < earliestReligionVal) {
                earliestReligion = religion;
                earliestReligionVal = religionStart[religion];
            }
        }

        var timelineYears = [];
        var timelineStart;
        var timelineEnd;
        var minYear;
        var maxYear = 2020;

        function createTimeline(yearStart, yearEnd) {
            for (var year = yearStart; year >= yearEnd; year -= 10) {
                timelineYears.push(year);
            }

            for (let i = timelineYears.length - 1; i >= 0; i--) {
                addTimelineOption(timelineYears[i]);
                }                      
        }

        if(religionFilter == "All Religions"){
            minYear = earliestReligionVal;
            timelineStart = maxYear;
            timelineEnd = maxYear - 190;
        } else {
            for (religion in religionStart) {
                if (religionFilter == religion){
                    majorReligion = true;

                    minYear = religionStart[religion];
                    timelineStart = maxYear;
                    timelineEnd = maxYear - 190;
                }
                if (!majorReligion) {
                    timelineSlider.hide();
                }
            }
        }

        function createSlider() {
            timelineYears = [];
            timelineOptions.empty();
            timelineOptions.append(timelinePrev);
            timelineOptions.append(createTimeline(timelineStart, timelineEnd));
            timelineOptions.append(timelineNext);
        }

        createSlider();
        $("input[type='radio'][value='" + maxYear + " CE']").prop("checked", true);


        $(document).on('click', '#timelinePrev', function() {
            timelineStart = timelineEnd;
            timelineEnd -= 190;
            
            if (timelineEnd <= minYear) {
                timelineEnd = minYear;
                timelineStart = minYear + 190;

                $('#timelinePrev').css("color", "#A6A6A6");
                $('#timelinePrev').css("cursor", "default");
            } else {
                $('#timelinePrev').css("color", "#000000");
                $('#timelinePrev').css("cursor", "pointer");
                $('#timelineNext').css("color", "#000000");
                $('#timelineNext').css("cursor", "pointer");
            }

            createSlider();
            });

        $(document).on('click', '#timelineNext', function() {
            timelineEnd = timelineStart;
            timelineStart += 190;
        
            if (timelineStart >= maxYear) {
                timelineEnd = maxYear - 190;
                timelineStart = maxYear;

                $('#timelineNext').css("color", "#A6A6A6");
                $('#timelineNext').css("cursor", "default");
            } else {
                $('#timelinePrev').css("color", "#000000");
                $('#timelinePrev').css("cursor", "pointer");
                $('#timelineNext').css("color", "#000000");
                $('#timelineNext').css("cursor", "pointer");
            }
        
            createSlider();
        });
    }

    function mapColor(religionFilter, timelineYear) {
        $.ajax({
            url: '../../ajax/getMapData.ajax.php',
            method: "POST",
            success:function(data){
                var religionByCountry = data;
                var prevailingReligionVal = 0;
                var countryColor = "";
                var applyFilter;
    
                function setMapFilter(religionFilter){
                    //set color based on filter
                    switch(religionFilter){
                        case "All Religions":
                            applyFilter = religionColors;
                            break;
                        case "Buddhism":
                            applyFilter = buddhismColors;
                            break;
                        case "Christianity":
                            applyFilter = christianityColors;
                            break;
                        case "Hinduism":
                            applyFilter = hinduismColors;
                            break;
                        case "Islam":
                            applyFilter = islamColors;
                            break;
                        case "Judaism":
                            applyFilter = judaismColors;
                            break;
                        case "Other Religions":
                            applyFilter = otherreligionsColors;
                            break;
                        case "Non-Religious":
                            applyFilter = nonreligiousColors;
                            break;
                    }
    
                    //set keys
                    var mapKeysText = "";
                    for (let color in applyFilter){
                        mapKeysText+= "<span class='dot' style='background-color: " + applyFilter[color] +"'></span>" + color + "<br>";
                    }
                    $('#colorKeys').html(mapKeysText);
    
                    //loop through all countries
                    for (let country in religionByCountry) {
                        var countryData = religionByCountry[country];
                        if(religionFilter == "All Religions"){
                            //determine prevailing religion of each country
                            for (let religion in countryData) {
                                if (countryData[religion] > prevailingReligionVal) {
                                    prevailingReligionVal = countryData[religion];
                                    prevailingReligion = religion;
    
                                    //set color of country to assigned color of prevailing religion
                                    for (let religionColor in religionColors){
                                        if (prevailingReligion == religionColor){
                                            countryColor = religionColors[religionColor];
                                        }
                                    }
                                }
                            }
                            document.getElementById(country).style.fill = countryColor;
                            document.getElementById(country).style.stroke = "#FFFFFF";
    
                            prevailingReligionVal = 0;
    
                        } else {
                            //color
                            var totalPopulation = 0;
                            var religionPercentage = 0;
                            var religionFilterVal = 0;
                            var countryData = religionByCountry[country];
    
                            //determine percentage of religion filters
                            for (let religion in countryData) {
                                totalPopulation += countryData[religion];
    
                                if(religionFilter == religion){
                                    religionFilterVal = countryData[religion];
                                }
                            }
    
                            religionPercentage = (Math.round(((religionFilterVal / totalPopulation) * 100) * 100) / 100).toFixed(2);
    
                            //set color of country depending on religion percentage
                            if(religionPercentage <= 20){
                                religionPercentage = "0% - 20%"
                            } else if(religionPercentage > 20 && religionPercentage <=40){
                                religionPercentage = "20% - 40%"
                            } else if(religionPercentage > 40 && religionPercentage <=60){
                                religionPercentage = "40% - 60%"
                            } else if(religionPercentage > 60 && religionPercentage <=80){
                                religionPercentage = "60% - 80%"
                            } else {
                                religionPercentage = "80% - 100%"
                            }
    
    
                            for (let percentage in applyFilter){
                                if (religionPercentage == percentage){
                                    countryColor = applyFilter[percentage];
                                }
                            }
                            document.getElementById(country).style.fill = countryColor;
                            document.getElementById(country).style.stroke = "#000000";
                            totalPopulation = 0;
                            religionPercentage = 0;
                            religionFilterVal = 0;
    
                        }
                    }
                }
    
                setMapFilter(religionFilter);
    
                var allCountries = document.getElementsByTagName("g");
                var chart;
    
                //highlight countries on hover and display content
                const countryHover = country => {
                    console.log(religionFilter);

                    var currentCountry = country.target.parentElement.id;
                    document.getElementById(currentCountry).style.opacity = 0.5; 
                    document.getElementById(currentCountry).setAttribute("data-toggle", "popover");
                    document.getElementById(currentCountry).setAttribute("data-html", "true");
    
                    //get total population
                    var totalPopulation = 0;
                    var religionPercentage = 0;
                    var religionVal = 0;
                    var popoverContent = "";
    
                    for (let country in religionByCountry) {
                        if (country == currentCountry){
                            var countryData = religionByCountry[country];
    
                            for (let religion in countryData) {
                                totalPopulation += countryData[religion];
        
                                if (religionFilter == "All Religions"){
                                    //prevailing religions
                                    if (countryData[religion] > religionVal) {
                                        religionVal = countryData[religion];
                                        prevailingReligion = religion;
                                    }   
                                } else {
                                    //religion filter
                                    if(religionFilter == religion){
                                        religionVal = countryData[religion];
                                    }
                                }
                            }
    
                            religionPercentage = (Math.round(((religionVal / totalPopulation) * 100) * 100) / 100).toFixed(2);
                        }
                    }

                    //set popover content
                    if(religionFilter == "All Religions"){
                        popoverContent = "The prevailing religion in " + currentCountry + " is " + prevailingReligion + ", comprising " + religionPercentage + "% of the population.";
                    } else {
                        popoverContent = religionFilter + " comprises " + religionPercentage + "% of " + currentCountry +"'s population.";
                    }
    
                    $('[data-toggle = "popover"]').popover({
                        title: currentCountry, 
                        content: popoverContent,
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
    }

    function mapPin(religionFilter, timelineYear) {
        //pins
        $.ajax({
            url: "../../ajax/getMapPinsData.ajax.php",
            method: "POST",
            success:function(data){
                var allPins = data;
                
                for (pin in allPins) {
                    var pinDetails = allPins[pin];

                    if (pinDetails.timelineDate == timelineYear) {
                        var pathElement = document.getElementById(pinDetails.country);
                        var boundingBox = pathElement.getBBox();
                        var x = boundingBox.x + (boundingBox.width / 4);
                        var y = boundingBox.y + (boundingBox.height / 4);
            
                        var pinTitle = pin;
                        var pinReligion = pinDetails.religion;
                        var pinDate = pinDetails.displayDate;
                        var pinShortDesc = pinDetails.shortDesc;
                        var pinDesc = pinDetails.description;
                        var pinType = pinDetails.pinType;
                        var pinPerson = pinDetails.relatedPerson;
                        var pinPersonImg = "../assets/data/map/img/" + pinPerson + ".jpg";
                        var pinVid = pinDetails.pinVid;
                        var pinImg1 = pinDetails.pinImg1;
                        var pinImg2 = pinDetails.pinImg2;
                        
                        var pinImg = "../assets/img/map/" + pinType + "-" + (pinReligion.toLowerCase()) + ".png";     
                        $("#svgMap").html($("#svgMap").html() + '<image id="' + pinTitle + '" class="mapPin" onmouseover="openPinOverview(' + "'" + pinTitle + "', '" + pinShortDesc + "'" + ')" onmouseout="closePinOverview(' + "'" + pinTitle + "'" + ')" onclick="openPin(' + "'" + pinTitle + "', '" + pinDate + "', '" + pinDesc + "', '" + pinReligion + "', '" + pinPerson + "', '" + pinPersonImg + "', '" + pinVid + "', '" + pinImg1 + "', '" + pinImg2 + "'" + ')" href="' + pinImg +'" x="' + x + '" y="' + y + '" height="15" width="15"/>');
                    }
                }          
            }
        });
    }


    //map view
    var geographicRegionFilter = "All Countries";
    $('#geographicRegionFilterOptions').click(function(){
        if($('#geographicRegionFilterOptions').val() != geographicRegionFilter){
            geographicRegionFilter = $('#geographicRegionFilterOptions').val();

            switch(geographicRegionFilter){
                case "All Countries":
                    $("#svgMap").attr("viewBox", "0 0 2000 857");
                    break;
                case "North America":
                    $("#svgMap").attr("viewBox", "0 0 1100 480");
                    break;
                case "Central America":
                    $("#svgMap").attr("viewBox", "0 150 1100 480");
                    break;
                case "South America":
                    $("#svgMap").attr("viewBox", "0 400 1100 480");
                    break;
                case "Europe":
                    $("#svgMap").attr("viewBox", "550 0 1100 480");
                    break;
                case "Middle East":
                    $("#svgMap").attr("viewBox", "750 50 1100 480");
                    break;
                case "Africa":
                    $("#svgMap").attr("viewBox", "500 240 1200 525");
                    break;
                case "Central Asia":
                    $("#svgMap").attr("viewBox", "770 0 1200 525");
                    break;
                case "South Asia":
                    $("#svgMap").attr("viewBox", "1100 180 800 350");
                    break;
                case "East and Southeast Asia":
                    $("#svgMap").attr("viewBox", "1000 150 1100 480");
                    break;
                case "Australia and Oceania":
                    $("#svgMap").attr("viewBox", "1200 400 1100 480");
                    break;
            }
        }
    });

    //help overlay
    $("#mapHelpButton").click(function(){
        $("#helpOverlay").css("display", "block");

        //display tooltip
        $("#Brazil").attr("data-toggle", "popover");
        $("#mapFilter").attr("data-toggle", "popover");
        $("input[type='radio'][value='1970 CE']").attr("data-toggle", "popover");

        $("#Brazil").popover({
            content: "Hover on a country to view its prevailing religion, and click on it for more information.",
            placement: "top"
        });

        $("#mapFilter").popover({
            content: "Filter the religion, geographic region, and pins on the map.",
            placement: "left"
        });

        $("input[type='radio'][value='1970 CE']").popover({
            content: "Click on a year to change the year displayed on the map.",
            placement: "top"
        });

        $('[data-toggle = "popover"]').popover("show");
    })

    $("#helpOverlay").click(function(){
        //hide tooltip
        $("#Brazil").removeAttr("data-toggle");
        $("#mapFilter").removeAttr("data-toggle");
        $("input[type='radio'][value='1970 CE']").removeAttr("data-toggle");

        $('.popover').popover('dispose');

        $("#helpOverlay").css("display", "none");
    });

    $("#pinOverlay").click(function () { 
        $("#pinOverlay").addClass("invisible");
    });
    
});

function openPin(pinTitle, pinDate, pinDesc, pinReligion, pinPerson, pinPersonImg, pinVid, pinImg1, pinImg2) {
    $("#pinOverlayTitle").text(pinTitle);
    $("#pinOverlayDate").text(pinDate);
    $("#pinOverlayDescription").text(pinDesc);
    $("#pinOverlayReligion").text(pinReligion);
    $("#pinOverlayPerson").text(pinPerson);
    
    $("#pinOverlayReligionImg").attr("src", "../assets/img/lib-" + pinReligion.toLowerCase() + ".png");
    $("#pinOverlayPersonImg").attr("src", pinPersonImg);
    $("#pinOverlayVideo").attr("src", pinVid);
    $("#pinOverlayImg1").attr("src", pinImg1);
    $("#pinOverlayImg2").attr("src", pinImg2);


    $("#pinOverlay").removeClass("invisible");
}

function openPinOverview(pinTitle, pinShortDesc) {
    document.getElementById(pinTitle).setAttribute("data-toggle", "popover");

    $('[data-toggle = "popover"]').popover({
        title: pinTitle, 
        content: pinShortDesc,
        placement: "top"
    });
    $('[data-toggle = "popover"]').popover("show");
}

function closePinOverview(pinTitle) {
    document.getElementById(pinTitle).removeAttribute("data-toggle", "popover");
    $('.popover').popover('dispose');
}