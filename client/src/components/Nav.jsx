import React from 'react'
import { Link } from 'react-router-dom'

const Nav = ({ scrollToFooter }) => {
  
  return (
    <div className='flex justify-between items-center p-8 py-6 w-full shadow-md'>
        <Link to='/' className="text-2xl font-bold">Website</Link>
        <ul className='flex'>
            <li><Link to='/'>Home</Link></li>
            <li><button onClick={scrollToFooter}>About</button></li>
            <li><Link to='/contact'>Contact</Link></li>
            <li><Link to='/favorite'>Favorite</Link></li>   
            <li className='rounded-lg bg-purple-500 text-white font-bold'><Link to="/auth/register">Sign up</Link></li>
        </ul>
    </div>
  )
}

export default Nav