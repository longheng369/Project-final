import { useReducer } from "react";
import fashion from "../assets/fashion-upscale.jpg";

const Hero = () => {
  return (
    <div className="w-full flex justify-center items-center bg-white">
      <img className="w-full" src={fashion} alt="image" />
    </div>
  );
};

export default Hero;
