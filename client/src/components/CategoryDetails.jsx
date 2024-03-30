import { useParams } from "react-router-dom";
import { categorysDetails } from "../data";
import SearchBar from "./SearchBar";
import { useState } from "react";
import DropDown from "./DropDown";
import { Details } from "./Details";
import { Card } from "./Card";
const CategoryDetails = () => {
  const [select, setSelect] = useState("All");
  const { id } = useParams();
  const [initialValue, setInitialValue] = useState("");
  function value(e) {
    setInitialValue(e);
  }

  const selectedValue = (value) => {
    setSelect(value);
    setInitialValue("");
  };

  // Initially filter data based on category ID
  let dataFilter = categorysDetails.filter((card) => card.category_id == id);

  // Further filter based on dropdown selection if not "All"
  if (select !== "All") {
    dataFilter = dataFilter.filter((card) =>
      card.title.toLowerCase().includes(select.toLowerCase())
    );
  }

  // Apply search filter if there is an initialValue
  if (initialValue) {
    dataFilter = dataFilter.filter((card) =>
      card.title.toLowerCase().includes(initialValue.toLowerCase())
    );
  }

  // const dataFilter = categorysDetails.filter(card => card.category_id == id);

  const options = ["All", "M", "Option 2", "Option 3"];

  return (
    <div>
      <div className="flex w-[99.3vw] justify-center mt-4 relative">
        <div className="absolute left-[100px] z-10">
          <DropDown options={options} selected={selectedValue} />
        </div>
        <SearchBar value={value} />
      </div>
      <div className="flex flex-wrap justify-center items-center gap-10 p-6 border-b-2">
        {dataFilter.map((card) => (
          <Details {...card} cid={card.id} key={card.id}/>
        ))}
      </div>
    </div>
  );
};

export default CategoryDetails;
