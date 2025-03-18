interface Team {
  id: number;
  name: string;
}

interface Match {
  id: number;
  teamHome: Team;
  teamAway: Team;
  dateMatch: string;
  scoreHome: number | null;
  scoreAway: number | null;
  status: "scheduled" | "in_progress" | "finished";
  class: string;
}

enum Status {
  scheduled = "Programmé",
  in_progress = "En cours",
  finished = "Terminé",
}

interface Matches {
  matches: Match[];
}

export type { Team, Match, Matches };
export { Status };
