import { increment,decrement } from "../Redux/Counter/counterSlice";
import { useDispatch, useSelector } from "react-redux";

const Favorite = () => {
  const count = useSelector(state => state.counter.value)
  const dispatch = useDispatch();
  return (
    <div className="w-full h-[80vh] bg-blue-200 flex flex-col justify-center items-center">
      <h1>{count}</h1>
      <button onClick={()=> dispatch(increment())} className="p-2 rounded-xl bg-blue-400 m-2">Increment</button>
      <button onClick={()=> dispatch(decrement())} className="p-2 rounded-xl bg-blue-400 m-2">Decrement</button>
    </div>
  );
};

export default Favorite;
