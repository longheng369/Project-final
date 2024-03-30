import { useState } from "react";
import Chat from "../components/Chat";
import Hero from "./Hero";
import NewArrival from "./NewArrival";
import ShopCategory from "./ShopCategory";
import { PiChatCenteredDotsFill } from "react-icons/pi";
import { CiGlass } from "react-icons/ci";

const Home = () => {
  const [toggle, setToggle] = useState(true);

  function handleToggle(){
    setToggle(!toggle)
    if(toggle == true){
      console.log(1)
    }
  }

  return (
    <div>
      <button
        onClick={handleToggle}
        className="bottom-4 right-4 fixed w-[60px] h-[60px] rounded-[50%] bg-gray-400 flex justify-center items-center text-[30px] text-white"
      >
        <PiChatCenteredDotsFill />
      </button>
      <div className={toggle ? "first hide" : "first"}>
        <Chat/>
      </div>
      <Hero />
      <NewArrival />
      <ShopCategory />
    </div>
  );
};

export default Home;
