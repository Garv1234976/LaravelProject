import { Head } from '@inertiajs/react';
import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import { dashboard } from '@/routes';
import React, { FormEvent, useState } from 'react';


type UserType = {
    name: string;
    age: string;
};

export default function Dashboard() {

    const [user, setUser] = useState<UserType>({
        name: '',
        age: ''
    })


    const handleSubmit = async (e:React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        
        const res = await fetch('/createUser', {
            method: 'POST',
            headers: {
                'Content-type': 'application/json',
            },
            body: JSON.stringify(user)
        })
        const data = await res.json();
        console.log(data);
    }
    return (
        <>
        <div className='px-3'>
            <div className='flex justify-center flex-col'>
                <p>Create user</p>
                <div className='flex'>
                    <form onSubmit={handleSubmit} className='bg-gray-500 p-3 rounded-md'>
                        <label htmlFor="">Name</label>
                        <br />
                        <input type="text" className='border' value={user.name} onChange={(e) => setUser({...user, name: e.target.value})}/>
                        <br />
                        <label htmlFor="">Age</label>
                        <br />
                        <input type="text" className='border' value={user.age} onChange={(e) => setUser({...user, age: e.target.value})}/>
                        <br />
                        <button className='bg-green-300 w-full my-2 rounded-2xl text-black font-bold' type='submit'>Add</button>
                    </form>
                    
                </div>
            </div>
        </div>
        </>
    );
}

Dashboard.layout = {
    breadcrumbs: [
        {
            title: 'Dashboard',
            href: dashboard(),
        },
    ],
};
