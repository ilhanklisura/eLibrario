var UserService = {
  open_edit_user_modal: function (user_id) {
    RestClient.get("get_user.php?id=" + user_id, function (data) {
      console.log("DATA IS ", data);
      $("#add-user-modal").modal("toggle");
      $("#add-user-form input[name='id']").val(data.id);
      $("#add-user-form input[name='first_name']").val(data.first_name);
      $("#add-user-form input[name='last_name']").val(data.last_name);
      $("#add-user-form input[name='email']").val(data.email);
      $("#add-user-form input[name='created_at']").val(data.created_at);
    });
  },
  delete_user: function (user_id) {
    if (confirm("Are you sure you want to delete this user?") == true) {
      RestClient.delete(
        "users/delete/" + user_id,
        { },
        function (data) {
          UserService.reload_users_table();
        }
      );
    } else {
      console("Dismissed!");
    }
  },
  reload_users_table: function() {
    Utils.get_datatable(
      "tbl_users",
      Constants.get_api_base_url() + "users",
      [
        { data: "action" },
        { data: "first_name" },
        { data: "last_name" },
        { data: "email" },
        { data: "created_at" },
      ]
    );
  }
};