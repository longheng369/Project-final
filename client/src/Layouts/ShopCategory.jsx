import React from "react";
import Category from "../components/Category";
import { categorys } from "../data";

const ShopCategory = () => {
  return (
    <div className="container mx-auto mb-10">
      <h2 className="text-center text-[3rem] p-4">Shop By Category</h2>
      <div className="grid grid-cols-5 gap-5">
        {categorys.map((category) => (
          <Category {...category} key={category.id} />
        ))}
      </div>
    </div>
  );
};

export default ShopCategory;
