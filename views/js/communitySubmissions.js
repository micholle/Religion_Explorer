$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#communitySubmissionsSidebar").html(data);
        }
    });

    $("#reportPhotoSubmission").click(function(){
        $('#reportContentModal').modal();
        $('#reportContentModal').show();
    });

    $("#reportVideoSubmission").click(function(){
        $('#reportContentModal').modal();
        $('#reportContentModal').show();
    });

    $("#reportReadMatSubmission").click(function(){
        $('#reportContentModal').modal();
        $('#reportContentModal').show();
    });

    const tabs = document.querySelectorAll('.communitySubmissionsTabBtn')
    const all_content = document.querySelectorAll('.communitySubmissionsContent')

    tabs.forEach((tab, index)=>{
        tab.addEventListener('click', (e)=>{
        tabs.forEach(tab=>{tab.classList.remove('active')})
        tab.classList.add('active');

        all_content.forEach(content=>{content.classList.remove('active')});
        all_content[index].classList.add('active');
        })
    })

    function activateTab(tabId) {
        const tabs = document.querySelectorAll(".communitySubmissionsTabBtn");
        const contents = document.querySelectorAll(".communitySubmissionsContent");
      
        // Remove the "active" class from all tabs and contents
        tabs.forEach((tab) => tab.classList.remove("active"));
        contents.forEach((content) => content.classList.remove("active"));
      
        // Activate the specified tab and content
        const activeTab = document.querySelector(`[data-tab="${tabId}"]`);
        const activeContent = document.getElementById(tabId);
        if (activeTab && activeContent) {
          activeTab.classList.add("active");
          activeContent.classList.add("active");
        }
    }
      
      // Check the URL for the "openTab" parameter and activate the corresponding tab
    const urlParams = new URLSearchParams(window.location.search);
    const openTabParam = urlParams.get("openTab");
        if (openTabParam) {
        activateTab(openTabParam);
    }      
});