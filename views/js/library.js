$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#librarySidebar").html(data);
        }
    });

    $("#libraryBuddhismInformation").click(function () { 
        var basicInformationContent = "Buddhism Basic Information";
        $("#libraryBasicInformationHeader").html("");
        $("#libraryBasicInformationHeader").append("Buddhism");
        $("#libraryBasicInformationHeader").append("<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>");
        $("#libraryBasicInformationContent").html(basicInformationContent);
        $("#libraryBasicInformationModal").modal();
    });

    $("#libraryChristianityInformation").click(function () { 
        var basicInformationContent = "Christianity Basic Information";
        $("#libraryBasicInformationHeader").html("");
        $("#libraryBasicInformationHeader").append("Christianity");
        $("#libraryBasicInformationHeader").append("<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>");
        $("#libraryBasicInformationContent").html(basicInformationContent);
        $("#libraryBasicInformationModal").modal();
    });

    $("#libraryHinduismInformation").click(function () { 
        var basicInformationContent = "Hinduism Basic Information";
        $("#libraryBasicInformationHeader").html("");
        $("#libraryBasicInformationHeader").append("Hinduism");
        $("#libraryBasicInformationHeader").append("<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>");
        $("#libraryBasicInformationContent").html(basicInformationContent);
        $("#libraryBasicInformationModal").modal();
    });

    $("#libraryIslamInformation").click(function () { 
        var basicInformationContent = "Islam Basic Information";
        $("#libraryBasicInformationHeader").html("");
        $("#libraryBasicInformationHeader").append("Islam");
        $("#libraryBasicInformationHeader").append("<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>");
        $("#libraryBasicInformationContent").html(basicInformationContent);
        $("#libraryBasicInformationModal").modal();
    });

    $("#libraryJudaismInformation").click(function () { 
        var basicInformationContent = "Judaism Basic Information";
        $("#libraryBasicInformationHeader").html("");
        $("#libraryBasicInformationHeader").append("Judaism");
        $("#libraryBasicInformationHeader").append("<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>");
        $("#libraryBasicInformationContent").html(basicInformationContent);
        $("#libraryBasicInformationModal").modal();
    });
});