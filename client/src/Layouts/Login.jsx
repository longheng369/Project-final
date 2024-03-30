import React, { useState } from "react";

const Login = () => {
  const [hide, setHide] = useState("password");
  const handleChange = (e) => {
    e.preventDefault();
    if (hide == "password") {
      setHide("text");
    } else {
      setHide("password");
    }
  };
  return (
    <div>
      <form className="w-[600px] rounded-lg shadow-lg flex flex-col border mx-auto my-20 p-10">
        <h1 className="text-center text-[2.5rem] text-purple-950">Login</h1>
        <div className="flex flex-col">
          <label htmlFor="Email" className="text-2xl">Email</label>
          <input id='Email' type="email" className="border outline-none text-xl rounded-lg shadow-sm px-4 py-2" />
        </div>
        <div className="mt-4">
          <label htmlFor="password" className="text-2xl">Password</label>
          <div className="flex">
            <input id='password' type={hide} className="flex-1 border outline-none text-xl rounded-lg shadow-sm px-4 py-2" />
            <button onClick={handleChange} className=" w-[50px] bg-blue-300 rounded-lg">Hide</button>
          </div>
        </div>
        <button className="p-2 rounded-lg text-xl font-bold text-white mt-4 bg-blue-400">Sumbit</button>
      </form>
    </div>
  );
};

export default Login;
