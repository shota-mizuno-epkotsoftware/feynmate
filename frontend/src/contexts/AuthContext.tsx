import { createContext, useContext, useState, useEffect } from "react"
import type { ReactNode } from 'react'
import client from '../api/client'


type User = {
    id: number;
    name: string;
    email: string;
}

type AuthContextType = {
    user: User | null;
    loading: boolean;
    login: (email: string, password: string) => Promise<void>;
    logout: () => Promise<void>;
}

const AuthContext = createContext<AuthContextType | null>(null);

export function AuthProvider({ children }: { children: ReactNode }) {
    const [user, setUser] = useState<User | null>(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        client.get('/user')
            .then(res => setUser(res.data))
            .catch(() => setUser(null))
            .finally(() => setLoading(false))
    }, []);

    const login = async (email: string, password: string) => {
        await client.get('/sanctum/csrf-cookie', { baseURL: '' });  // 一時的にbaseURLを'/'にする
        await client.post('/login', { email, password });
        const res = await client.get('/user');
        setUser(res.data);
    };

    const logout = async () => {
        await client.post('/logout');
        setUser(null);
    };

    return (
        <AuthContext.Provider value={{ user, loading, login, logout }}>
            {children}
        </AuthContext.Provider>
    );
}

export function useAuth() {
    const ctx = useContext(AuthContext);
    if (!ctx) {
        throw new Error('useAuth must bu used within AuthProvider');
    }
    return ctx;
}