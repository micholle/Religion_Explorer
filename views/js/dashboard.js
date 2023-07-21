$(function() {
    $.ajax({
        url: "../../ajax/showAdminSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#dashboardSidebar").html(data);

            $("#dashboardSidebar li a").each(function() {
                var tabPage = $(this).attr("href");
                if (tabPage === currentPage) {
                   $(this).addClass("active");
                }
            });
        }
    });

    $.ajax({
        url: "../../ajax/getDashboardData.ajax.php",
        method: "POST",
        success: function (data) {
            var dashboardData = data;
    
            var todayNewUsers = dashboardData.todayNewUsers;
            var visitors = dashboardData.visitors;
            var registeredUsers = dashboardData.registeredUsers;
        
            $("#todaysNewUsers").text(todayNewUsers);
            $("#visitors").text(visitors);
            $("#registeredUsers").text(registeredUsers);
        
            //Registered Users
            var registeredBuddhists = dashboardData.registeredBuddhists;
            var registeredChristians = dashboardData.registeredChristians;
            var registeredHindus = dashboardData.registeredHindus;
            var registeredIslams = dashboardData.registeredIslams;
            var registeredJews = dashboardData.registeredJews;
            var registeredOtherReligions = dashboardData.registeredOtherReligions;
            var registeredNonReligious = dashboardData.registeredNonReligious;
        
            const labels = ['Buddhism', 'Christianity', 'Hinduism', 'Islam', 'Judaism', 'Other Religions', 'Non-Religious'];
        
            const registeredUsersData = {
                labels: labels,
                datasets: [{
                    label: 'Registered Users',
                    data: [registeredBuddhists, registeredChristians, registeredHindus, registeredIslams, registeredJews, registeredOtherReligions, registeredNonReligious],
                    backgroundColor: [
                        'rgba(186, 164, 0, 0.2)',
                        'rgba(86, 9, 122, 0.2)',
                        'rgba(168, 19, 21, 0.2)',
                        'rgba(1, 135, 68, 0.2)',
                        'rgba(19, 52, 168, 0.2)',
                        'rgba(179, 113, 0, 0.2)',
                        'rgba(36, 36, 36, 0.2)'
                    ],
                    borderColor: [
                        'rgb(186, 164, 0)',
                        'rgb(86, 9, 122)',
                        'rgb(168, 19, 21)',
                        'rgb(1, 135, 68)',
                        'rgb(19, 52, 168)',
                        'rgb(179, 113, 0)',
                        'rgb(36, 36, 36)'
                    ],
                    borderWidth: 1
                }]
            };
            
            const config = {
                type: 'bar',
                data: registeredUsersData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };
            
            const canvasElement = document.createElement('canvas');
            canvasElement.id = 'registeredUsersReligion';
            document.getElementById('registeredUsersReligionContainer').appendChild(canvasElement);
            
            const ctx = document.getElementById('registeredUsersReligion').getContext('2d');
            new Chart(ctx, config);
            
            //Monthly New Users
            var januaryUsers = dashboardData.januaryUsers;
            var februaryUsers = dashboardData.februaryUsers;
            var marchUsers = dashboardData.marchUsers;
            var aprilUsers = dashboardData.aprilUsers;
            var mayUsers = dashboardData.mayUsers;
            var juneUsers = dashboardData.juneUsers;
            var julyUsers = dashboardData.julyUsers;
            var augustUsers = dashboardData.augustUsers;
            var septemberUsers = dashboardData.septemberUsers;
            var octoberUsers = dashboardData.octoberUsers;
            var novemberUsers = dashboardData.novemberUsers;
            var decemberUsers = dashboardData.decemberUsers;
        
            const monthlyUsersLabels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            
            const monthlyUsersData = {
                labels: monthlyUsersLabels,
                datasets: [{
                    label: 'Monthly New Users',
                    data: [januaryUsers, februaryUsers, marchUsers, aprilUsers, mayUsers, juneUsers, julyUsers, augustUsers, septemberUsers, octoberUsers, novemberUsers, decemberUsers],
                    backgroundColor: [
                        'rgba(44, 164, 100, 0.2)',
                        'rgba(44, 164, 100, 0.2)',
                        'rgba(44, 164, 100, 0.2)',
                        'rgba(44, 164, 100, 0.2)',
                        'rgba(44, 164, 100, 0.2)',
                        'rgba(44, 164, 100, 0.2)',
                        'rgba(44, 164, 100, 0.2)',
                        'rgba(44, 164, 100, 0.2)',
                        'rgba(44, 164, 100, 0.2)',
                        'rgba(44, 164, 100, 0.2)',
                        'rgba(44, 164, 100, 0.2)',
                        'rgba(44, 164, 100, 0.2)'
                    ],
                    borderColor: [
                        'rgb(44, 164, 100)',
                        'rgb(44, 164, 100)',
                        'rgb(44, 164, 100)',
                        'rgb(44, 164, 100)',
                        'rgb(44, 164, 100)',
                        'rgb(44, 164, 100)',
                        'rgb(44, 164, 100)',
                        'rgb(44, 164, 100)',
                        'rgb(44, 164, 100)',
                        'rgb(44, 164, 100)',
                        'rgb(44, 164, 100)',
                        'rgb(44, 164, 100)'
                    ],
                    borderWidth: 1
                }]
            };
            
            const monthlyUsersConfig = {
                type: 'bar',
                data: monthlyUsersData,
                options: {
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true,
                        },
                    },
                },
            };
        
            const monthlyUsersCanvasElement = document.createElement('canvas');
            monthlyUsersCanvasElement.id = 'monthlyNewUsers';
        
            const monthlyUsersCanvasContainer = document.getElementById('monthlyNewUsersContainer');
            monthlyUsersCanvasContainer.appendChild(monthlyUsersCanvasElement);
            
            const monthlyUsersCtx = document.getElementById('monthlyNewUsers').getContext('2d');
            new Chart(monthlyUsersCtx, monthlyUsersConfig);
        }
    });
    
});
