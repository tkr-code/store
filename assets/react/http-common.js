import axios from "axios";

export default axios.create({
  baseURL: "https://localhost:8000/api",
  headers: {
    "Content-type": "application/id+json"
  }
});
