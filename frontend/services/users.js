var UserService = {
  reload_users_datatable: function () {
    Utils.get_datatable(
      "users",
      Constants.get_api_base_url() + "users", // get_patients.php
      [
        { data: "action" },
        { data: "first_name" },
        { data: "last_name" },
        { data: "created_at" },
        { data: "email" },
      ]
    );
  },
  open_edit_user_modal: function (user_id) {
    RestClient.get("users/" + user_id, function (data) {
      $("#add-user-modal").modal("toggle");
      $("#add-user-form input[name='id']").val(data.id);
      $("#add-user-form input[name='first_name']").val(data.first_name);
      $("#add-user-form input[name='last_name']").val(data.last_name);
      $("#add-user-form input[name='email']").val(data.email);
      $("#add-user-form input[name='created_at']").val(data.created_at);
    });
  },
  delete_user: function (user_id) {
    if (
      confirm(
        "Do you want to delete user with the id " + user_id + "?"
      ) == true
    ) {
      RestClient.delete(
        "users/delete/" + user_id,
        {},
        function (data) {
          UserService.reload_users_datatable();
        }
      );
    }
  },
};
