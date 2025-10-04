import fs from "fs";
import path from "path";
import bcrypt from "bcrypt";

export default async function handler(req, res) {
  if (req.method !== "POST") {
    return res.status(405).send("Method Not Allowed");
  }

  const { username, password } = req.body;
  const filePath = path.resolve(process.cwd(), "users.json");
  const users = JSON.parse(fs.readFileSync(filePath, "utf-8"));

  if (!users[username]) {
    return res.status(401).send("Invalid credentials");
  }

  const match = await bcrypt.compare(password, users[username]);
  if (match) {
    return res.status(200).send("Authenticated");
  } else {
    return res.status(401).send("Invalid credentials");
  }
}
