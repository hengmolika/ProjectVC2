import axios from "axios";

const TOKEN = localStorage.getItem("token");

export default axios.create({
  baseURL: process.env.VUE_APP_API_URL,
  headers: {
    "Content-type": "application/json",
    'Authorization': 'Bearer '+ TOKEN
  }
});
