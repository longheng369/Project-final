import React from "react";
import { FaTiktok } from "react-icons/fa";
import { FaTelegramPlane } from "react-icons/fa";
import { FaFacebookSquare } from "react-icons/fa";

const Footer = () => {
  return (
    <div className="w-full h-[40vh] bg-gray-600 grid grid-cols-2 p-20">
      <div className="flex flex-col text-3xl gap-6">
        <div className="flex items-center text-white gap-6">
          <FaTiktok />
          <h1>Tiktok Account</h1>
        </div>
        <div className="flex items-center text-white gap-6">
          <FaTelegramPlane />
          <h1>012345678</h1>
        </div>
        <div className="flex items-center text-white gap-6">
          <FaFacebookSquare />
          <h1>Facebook Acccount</h1>
        </div>
      </div>
      {/* <--- right ---> */}
      <div >
        <h1 className="text-2xl text-white">About Us</h1>
        <div className="flex flex-col text-2xl gap-3 text-white">
          <h1>1- Name 1</h1>
          <h1>2- Name 2</h1>
          <h1>3- Name 3</h1>
        </div>
      </div>
    </div>
  );
};

export default Footer;
