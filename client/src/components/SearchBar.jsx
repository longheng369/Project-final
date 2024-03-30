import { IoIosSearch } from "react-icons/io";
const SearchBar = ({value}) => {
    function InputChange(e){
        value(e)
    }
  return (
    <div className="flex w-4/12 justify-center items-center border-[1.5px] border-gray-400 rounded-[50px] px-6 py-2">
      <input className="w-full text-xl bg-transparent outline-none" type="text" placeholder="Search..." onChange={(e) => InputChange(e.target.value)} />
      <button className="text-2xl border-none">
        <IoIosSearch />
      </button>
    </div>
  );
};

export default SearchBar;
