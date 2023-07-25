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

            var currentPage = window.location.pathname.split("/").pop();

            $("#mapSidebar li a").each(function() {
                var tabPage = $(this).attr("href");
                if (tabPage === currentPage) {
                    $(this).addClass("active");
                }
            });
        }
    });

    var svgPanZoom = $("svg").svgPanZoom();

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

    var mapPlain = $("#svgMap").html();

    //initialize default filter and timeline
    var religionFilter = "All Religions";
    var timelineYear = "2010 CE";

    //initialize map
    $("#timelineOverlayYear").text(timelineYear);
    $("#timelineOverlay").css("display", "block");
    mapTimeline(religionFilter);
    mapColor(religionFilter, timelineYear);
    mapPin(religionFilter, timelineYear);

    //change map data based on filter
    $('#religionFilterOptions').click(function(){
        if($('#religionFilterOptions').val() != religionFilter){
            $("#svgMap").html(mapPlain);

            religionFilter = $('#religionFilterOptions').val();
            mapTimeline(religionFilter);
            mapColor(religionFilter, timelineYear);
            mapPin(religionFilter, timelineYear);
        }
    });

    var mapEvents = "show";
    var mapPeople = "show";
    var mapLocations = "show";

    $("#mapEvents").click(function () { 
        $("#svgMap").html(mapPlain);

        if ($("#mapEvents").prop("checked")) {
            mapEvents = "show";
        } else {
            mapEvents = "hide";
        }

        mapPin(religionFilter, timelineYear);
    });

    $("#mapPeople").click(function () { 
        $("#svgMap").html(mapPlain);

        if ($("#mapPeople").prop("checked")) {
            mapPeople = "show";
        } else {
            mapPeople = "hide";
        }

        mapPin(religionFilter, timelineYear);
    });

    $("#mapLocations").click(function () { 
        $("#svgMap").html(mapPlain);

        if ($("#mapLocations").prop("checked")) {
            mapLocations = "show";
        } else {
            mapLocations = "hide";
        }

        mapPin(religionFilter, timelineYear);
    });

    $("#timelineOverlay").click(function () { 
        $("#timelineOverlay").css("display", "none");
    });

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

        $("#svgMap").html(mapPlain);
    
        mapColor(religionFilter, timelineYear);
        mapPin(religionFilter, timelineYear);
    
        $("#timelineOverlayYear").text(timelineYear);
        $("#timelineOverlay").css("display", "block");

        //do not show overlay if the same year is clicked
    }

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
        var maxYear = 2010;

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
                    for (let year in religionByCountry) {
                        if (year != timelineYear) {
                            $("#mapDataNotice").removeAttr("hidden");
                        } else {
                            $("#mapDataNotice").attr("hidden", true);

                        }
                        var countryDetails = religionByCountry[year];
                        for (let country in countryDetails) {
                            var religionValues = countryDetails[country];
                            
                            if(religionFilter == "All Religions"){
                                //determine prevailing religion of each country
                                for (let religion in religionValues) {
                                    if (religionValues[religion] > prevailingReligionVal) {
                                        prevailingReligionVal = religionValues[religion];
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
                                // var religionValues = religionValues[religion];
        
                                //determine percentage of religion filters
                                for (let religion in religionValues) {
                                    totalPopulation += religionValues[religion];
                                    
                                    if(religionFilter == religion){
                                        religionFilterVal = religionValues[religion];
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
                }
    
                setMapFilter(religionFilter);
    
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
                    var religionPercentage = 0;
                    var religionVal = 0;
                    var popoverContent = "";
    
                    for (let year in religionByCountry) {
                        var countryDetails = religionByCountry[year];
                        for (let country in countryDetails) {
                            var religionValues = countryDetails[country];
                            if (country == currentCountry){
        
                                for (let religion in religionValues) {
                                    totalPopulation += religionValues[religion];
            
                                    if ($('#religionFilterOptions').val() == "All Religions"){
                                        //prevailing religions
                                        if (religionValues[religion] > religionVal) {
                                            religionVal = religionValues[religion];
                                            prevailingReligion = religion;
                                        }   
                                    } else {
                                        //religion filter
                                        if($('#religionFilterOptions').val() == religion){
                                            religionVal = religionValues[religion];
                                        }
                                    }
                                }
        
                                religionPercentage = (Math.round(((religionVal / totalPopulation) * 100) * 100) / 100).toFixed(2);
                            }
                        }
                    }

                    //set popover content
                    if($('#religionFilterOptions').val() == "All Religions"){
                        popoverContent = "The prevailing religion in " + currentCountry + " is " + prevailingReligion + ", comprising " + religionPercentage + "% of the population.";
                    } else {
                        popoverContent = $('#religionFilterOptions').val() + " comprises " + religionPercentage + "% of " + currentCountry +"'s population.";
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
                    const canvasElement = document.createElement('canvas');
                    canvasElement.id = 'religionChart';
                    $("#showReligionChart").html(canvasElement);
                    var religionChart = document.getElementById("religionChart").getContext("2d");
                    
                    var totalPopulation = 0;
                    var religionDataDict = {};
                    var religions = [];
                    var religionData = [];
                    var religionColors = ["#BAA400", "#56097A", "#A81315", "#018744", "#1334A8", "#B37100", "#242424"];
            
                    for (let religion of Object.keys(religionByCountry[Object.keys(religionByCountry)[0]][currentCountry])) {
                        religionDataDict[religion] = 0;
                    }

                    for (let year in religionByCountry) {
                        var countryDetails = religionByCountry[year];
                        for (let country in countryDetails) {
                            var religionValues = countryDetails[country];
                
                            if (country == currentCountry){
                                for (let religion in religionValues) {
                                    religions.push(religion);
                                    religionData.push(religionValues[religion]);
                                    religionDataDict[religion] += religionValues[religion];
                                    totalPopulation += religionValues[religion];
                                }
                            }
                        }
                    }

                    Chart.defaults.font.family = "Lexend";

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
                    }
                    
                    chart = new Chart(religionChart, configuration);


                    function calculatePercentage(count, totalPopulation) {
                        return ((count / totalPopulation) * 100).toFixed(2);
                    }
    
                    var sortedReligions = Object.keys(religionDataDict).sort((a, b) => religionDataDict[b] - religionDataDict[a]);    

                    var modalContent = "The chart displays the distribution of religious affiliations in <b>" + currentCountry + "</b>, presenting the number of people per religion. The most prevalent is <b>" + sortedReligions[0] + "</b>, amounting to <b>" + religionDataDict[sortedReligions[0]].toLocaleString() + "</b> people or <b>" + calculatePercentage(religionDataDict[sortedReligions[0]], totalPopulation) + "%</b> of the total population. Following that are ";

                    for (let i = 1; i < sortedReligions.length; i++) {
                        if (i === sortedReligions.length - 1) {
                            modalContent += "and ";
                        }
                        modalContent += sortedReligions[i] + " at " + religionDataDict[sortedReligions[i]].toLocaleString() + " (" + calculatePercentage(religionDataDict[sortedReligions[i]], totalPopulation) + "%), ";
                    }

                    modalContent += "respectively. While interpreting the data, it's essential to consider historical and social factors that may influence these religious demographics. Additionally, it's worth noting that the accuracy of the chart relies on the data's limitations and the broader context of the country's religious landscape.";

                    $("#modalContent").html(modalContent);
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

                    var pathElement = document.getElementById(pinDetails.country);
                    var boundingBox = pathElement.getBBox();
                    var x = boundingBox.x + (boundingBox.width / 4);
                    var y = boundingBox.y + (boundingBox.height / 4);
        
                    var pinid = pinDetails.pinid;
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
                    $("#svgMap").html($("#svgMap").html() + '<image id="' + pinid + '" class="mapPin" onmouseover="openPinOverview(' + "'" + pinid + "', '" + pinTitle + "', '" + pinShortDesc + "'" + ')" onmouseout="closePinOverview(' + "'" + pinid + "'" + ')" onclick="openPin(' + "'" + pinTitle + "', '" + pinDate + "', '" + pinDesc + "', '" + pinReligion + "', '" + pinPerson + "', '" + pinPersonImg + "', '" + pinVid + "', '" + pinImg1 + "', '" + pinImg2 + "'" + ')" href="' + pinImg +'" x="' + x + '" y="' + y + '" height="30" width="30"/>');
                    
                    var pinid = "#" + pinid;
                    var pinTypeStatus = "";
                    mapColor(religionFilter, timelineYear);

                    if(pinType == "event") {
                        pinTypeStatus = mapEvents;
                    } else if(pinType == "person") {
                        pinTypeStatus = mapPeople;
                    } else {
                        pinTypeStatus = mapLocations;
                    }

                    if ((pinDetails.timelineDate == timelineYear) && (($('#religionFilterOptions').val() == "All Religions") || (pinReligion == $('#religionFilterOptions').val())) && (pinTypeStatus == "show")) {
                        $(pinid).removeAttr("hidden");
                    } else {
                        $(pinid).attr("hidden", true);
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

    //search country
    $("#searchCountryInput").keyup(function () { 
        $.ajax({
            url: '../../ajax/getMapData.ajax.php',
            method: "POST",
            success:function(data){
                var religionByCountry = data;

                for (let year in religionByCountry) {
                    var countryDetails = religionByCountry[year];
                    for (let country in countryDetails) {
                        if ($("#searchCountryInput").val() == "") {
                            $("#svgMap").attr("viewBox", "0 0 2000 857");
                            document.getElementById(country).style.opacity = 1; 
                            document.getElementById(country).removeAttribute("data-toggle", "popover");
                            $('.popover').popover('dispose');
                        } else {
                            if ((country.toLowerCase()).includes($("#searchCountryInput").val())) {
                                var pathElement = document.getElementById(country);
                                var boundingBox = pathElement.getBBox();
                                var x = boundingBox.x - 1000;
                                var y = boundingBox.y - 300;
        
                                $("#svgMap").attr("viewBox", x + " " + y + " 2000 857");
                                document.getElementById(country).style.opacity = 0.5; 
                                document.getElementById(country).setAttribute("data-toggle", "popover");
                                document.getElementById(country).setAttribute("data-html", "true");

                                $('[data-toggle = "popover"]').popover({
                                    title: country, 
                                    content: "Hover or click to learn more about " + country + ".",
                                    placement: "top"
                                });
                                $('[data-toggle = "popover"]').popover("show");

                                break;
                            } else {
                                $("#svgMap").attr("viewBox", "0 0 2000 857"); 
                                document.getElementById(country).style.opacity = 1; 
                                document.getElementById(country).removeAttribute("data-toggle", "popover");
                                $('.popover').popover('dispose');
                            }
                        }
                    }
                }
            }
        });
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

function openPinOverview(pinid, pinTitle, pinShortDesc) {
    document.getElementById(pinid).setAttribute("data-toggle", "popover");

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