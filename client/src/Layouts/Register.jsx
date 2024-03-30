import { useState } from "react";
import { Link } from "react-router-dom";

const Register = () => {
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
        <h1 className="text-center text-[2.5rem] text-purple-950">Register</h1>
        <div className="flex flex-col">
          <label htmlFor="name" className="text-2xl">
            Username
          </label>
          <input
            id="name"
            type="text"
            className="border outline-none text-xl rounded-lg shadow-sm px-4 py-2"
          />
        </div>
        <div className="flex flex-col mt-4">
          <label htmlFor="Email" className="text-2xl">
            Email
          </label>
          <input
            id="Email"
            type="email"
            className="border outline-none text-xl rounded-lg shadow-sm px-4 py-2"
          />
        </div>
        <div className="mt-4">
          <label htmlFor="password" className="text-2xl">
            Password
          </label>
          <div className="flex">
            <input
              id="password"
              type={hide}
              className="flex-1 border outline-none text-xl rounded-lg shadow-sm px-4 py-2"
            />
            <button
              onClick={handleChange}
              className=" w-[50px] bg-blue-300 rounded-lg"
            >
              Hide
            </button>
          </div>
        </div>
        <button className="p-2 rounded-lg text-xl font-bold text-white mt-4 bg-blue-400">
          Sumbit
        </button>
        <div className="flex py-4 text-lg">
            <p>Already have an account?</p>
            <Link to="/auth" className="ml-4 text-purple-700 font-bold underline">Sign in</Link>
        </div>
      </form>
    </div>
  );
};

export default Register;
