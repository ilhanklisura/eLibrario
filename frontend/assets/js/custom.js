$(document).ready(function () {
   // Define SPApp
   var app = $.spapp({
      defaultView: "login",
      templateDir: "./tpl/",
   });

   // Routes for Admin
   app.route({ view: "admin-add-activity", load: "admin/add-activity.html" });
   app.route({ view: "admin-index", load: "admin/index.html" });
   app.route({ view: "admin-kanban", load: "admin/kanban.html" });
   app.route({ view: "admin-profile", load: "admin/profile.html" });
   app.route({ view: "admin-project-add", load: "admin/project-add.html" });
   app.route({
      view: "admin-project-detail",
      load: "admin/project-detail.html",
   });
   app.route({ view: "admin-project-edit", load: "admin/project-edit.html" });
   app.route({ view: "admin-projects", load: "admin/projects.html" });
   app.route({ view: "admin-view-activity", load: "admin/view-activity.html" });
   app.route({ view: "admin-working-hours", load: "admin/working-hours.html" });

   // Routes for Employee
   app.route({
      view: "employee-add-activity",
      load: "employee/add-activity.html",
   });
   app.route({ view: "employee-index", load: "employee/index.html" });
   app.route({ view: "employee-kanban", load: "employee/kanban.html" });
   app.route({ view: "employee-profile", load: "employee/profile.html" });
   app.route({
      view: "employee-project-detail",
      load: "employee/project-detail.html",
   });
   app.route({ view: "employee-projects", load: "employee/projects.html" });
   app.route({
      view: "employee-working-hours",
      load: "employee/working-hours.html",
   });

   // Routes for Common views (Login, Register)
   app.route({ view: "forgot-password", load: "common/forgot-password.html" });
   app.route({ view: "login", load: "common/login.html" });
   app.route({
      view: "recover-password",
      load: "common/recover-password.html",
   });
   app.route({ view: "register", load: "common/register.html" });

   app.run();
});
