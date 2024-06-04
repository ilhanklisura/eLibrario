var Constants = {
  get_api_base_url: function () {
    if (location.hostname == "localhost") {
      return "http://localhost:8888/TalentTrack/backend/";
    } else {
      return "https://walrus-app-dere7.ondigitalocean.app/dentist-backend/";
    }
  },
};